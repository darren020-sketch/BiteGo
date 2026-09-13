<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Langkah 1 & 2 : form pemesanan satu menu.
     */
    public function create(Menu $menu)
    {
        if (! $menu->is_available || $menu->stock < 1) {
            return back()->with('error', 'Menu ini sudah tidak tersedia.');
        }

        $menu->load('stall');

        return view('orders.create', [
            'menu' => $menu,
            'pickupSlots' => ['istirahat_1' => 'Istirahat I', 'istirahat_2' => 'Istirahat II'],
        ]);
    }

    /**
     * Simpan pesanan baru + buat kode unik 4 digit.
     */
    public function store(Request $request, Menu $menu)
    {
        if (! $menu->is_available || $menu->stock < 1) {
            return back()->with('error', 'Menu ini sudah tidak tersedia.');
        }

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
            'pickup_slot' => ['required', 'in:istirahat_1,istirahat_2'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $quantity = (int) $data['quantity'];

        if ($quantity > $menu->stock) {
            return back()->with('error', "Stok tidak mencukupi. Sisa stok: {$menu->stock}.");
        }

        $pickupCode = $this->generateUniquePickupCode();
        $orderNumber = 'BG-'.date('Ymd').'-'.strtoupper(Str::random(5));

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $request->user()->id,
            'stall_id' => $menu->stall_id,
            'pickup_slot' => $data['pickup_slot'],
            'pickup_code' => $pickupCode,
            'status' => 'menunggu',
            'total_amount' => $menu->price * $quantity,
            'total_qty' => $quantity,
            'notes' => $data['notes'] ?? null,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'menu_id' => $menu->id,
            'menu_name' => $menu->name,
            'menu_image' => $menu->image,
            'price' => $menu->price,
            'quantity' => $quantity,
            'subtotal' => $menu->price * $quantity,
        ]);

        $menu->decrement('stock', $quantity);

        return redirect()->route('orders.success', $order)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Halaman sukses / bukti kode unik pengambilan.
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items', 'stall']);

        return view('orders.success', compact('order'));
    }

    /**
     * Halaman daftar pesanan user.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->with(['stall', 'items'])
            ->latest('id')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Halaman detail / lacak pesanan.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items', 'stall']);

        return view('orders.show', compact('order'));
    }

    /**
     * Batalkan pesanan yang belum diproses penjual.
     */
    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (! in_array($order->status, ['menunggu'])) {
            return back()->with('error', 'Pesanan sudah diproses dan tidak dapat dibatalkan.');
        }

        $order->update(['status' => 'dibatalkan']);

        foreach ($order->items as $item) {
            if ($item->menu) {
                $item->menu->increment('stock', $item->quantity);
            }
        }

        return back()->with('success', 'Pesanan dibatalkan.');
    }

    private function generateUniquePickupCode(): string
    {
        do {
            $code = str_pad((string) mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Order::whereDate('created_at', today())
            ->where('pickup_code', $code)
            ->exists());

        return $code;
    }
}
