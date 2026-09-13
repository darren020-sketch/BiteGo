<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Dashboard penjual: rekap pesanan real-time per status.
     */
    public function dashboard()
    {
        $stall = Auth::user()->stall;

        if (! $stall) {
            return view('vendor.dashboard', ['stall' => null]);
        }

        $orders = $stall->orders()->with(['items', 'user'])->latest('id')->get();

        $counts = [
            'menunggu' => $orders->where('status', 'menunggu')->count(),
            'dimasak' => $orders->where('status', 'dimasak')->count(),
            'siap_ambil' => $orders->where('status', 'siap_ambil')->count(),
            'selesai' => $orders->where('status', 'selesai')->count(),
            'dibatalkan' => $orders->where('status', 'dibatalkan')->count(),
            'revenue' => $orders->whereIn('status', ['selesai', 'siap_ambil', 'dimasak', 'menunggu'])
                ->sum('total_amount'),
        ];

        return view('vendor.dashboard', compact('stall', 'orders', 'counts'));
    }

    /**
     * Update status pesanan (Menunggu → Dimasak → Siap Ambil → Selesai).
     */
    public function updateStatus(Request $request, Order $order)
    {
        if ($order->stall->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'status' => ['required', 'in:menunggu,dimasak,siap_ambil,selesai,dibatalkan'],
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('success', "Status pesanan {$order->order_number} diperbarui menjadi \"{$order->status_label}\".");
    }

    /**
     * Kelola menu & stok milik stand penjual yang sedang login.
     */
    public function menus()
    {
        $stall = Auth::user()->stall;

        if (! $stall) {
            return view('vendor.menu', ['stall' => null, 'menus' => collect(), 'categories' => collect(), 'stats' => []]);
        }

        $menus = $stall->menus()->with('category')->orderBy('category_id')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        $stats = [
            'total' => $menus->count(),
            'stock' => $menus->sum('stock'),
            'available' => $menus->where('is_available', true)->count(),
            'popular' => $menus->where('is_popular', true)->count(),
        ];

        return view('vendor.menu', compact('stall', 'menus', 'categories', 'stats'));
    }

    /**
     * Tambah menu baru ke stand penjual.
     */
    public function menuStore(Request $request)
    {
        $stall = Auth::user()->stall;

        if (! $stall) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('menus')->where(fn ($q) => $q->where('stall_id', $stall->id))],
            'description' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'integer', 'min:100', 'max:10000000'],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
            'image' => ['nullable', 'url', 'max:255'],
        ]);

        $stall->menus()->create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']).'-'.Str::lower(Str::random(4)),
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image' => $data['image'] ?? null,
            'is_available' => true,
            'is_popular' => false,
        ]);

        return redirect()->route('vendor.menu.index')
            ->with('success', "Menu \"{$data['name']}\" berhasil ditambahkan ke stand Anda.");
    }

    /**
     * Perbarui stok & harga menu milik penjual.
     */
    public function menuUpdate(Request $request, Menu $menu)
    {
        $this->authorizeMenuOwner($menu);

        $data = $request->validate([
            'price' => ['required', 'integer', 'min:100', 'max:10000000'],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
        ]);

        $menu->update([
            'price' => $data['price'],
            'stock' => $data['stock'],
            'is_available' => $request->boolean('is_available'),
            'is_popular' => $request->boolean('is_popular'),
        ]);

        return back()->with('success', "Menu \"{$menu->name}\" berhasil diperbarui.");
    }

    /**
     * Hapus menu milik penjual.
     */
    public function menuDestroy(Menu $menu)
    {
        $this->authorizeMenuOwner($menu);

        $menu->delete();

        return back()->with('success', "Menu \"{$menu->name}\" telah dihapus.");
    }

    /**
     * Pastikan menu benar-benar milik penjual yang sedang login.
     */
    private function authorizeMenuOwner(Menu $menu): void
    {
        if ($menu->stall->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
