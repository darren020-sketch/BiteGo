@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
    <div class="max-w-2xl mx-auto">
        {{-- Success header --}}
        <div class="text-center mb-8 pt-4">
            <div class="w-20 h-20 bg-emerald-500 rounded-full flex items-center justify-center text-white text-3xl shadow-xl shadow-emerald-500/30 mx-auto mb-5">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-900">Pesanan Berhasil! 🎉</h2>
            <p class="text-sm text-gray-500 mt-2">Pesananmu sudah masuk ke daftar penjual. Simpan kode ini baik-baik ya!</p>
        </div>

        {{-- Pickup code card --}}
        <div class="bg-gradient-to-br from-mint-700 to-mint-500 rounded-3xl p-8 text-white text-center shadow-xl shadow-emerald-500/20 mb-6 relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-14 -right-10 w-44 h-44 bg-white/10 rounded-full"></div>
            <p class="text-xs text-emerald-100 uppercase tracking-widest font-semibold relative">Kode Unik Pengambilan</p>
            <div class="font-mono text-6xl font-extrabold tracking-[0.3em] mt-3 mb-4 relative" style="text-shadow: 0 2px 12px rgba(0,0,0,0.15)">
                {{ $order->pickup_code }}
            </div>
            <p class="text-[11px] text-emerald-100 relative">
                <i class="fa-solid fa-location-dot mr-1"></i>
                Ambil di Express Pickup · {{ $order->stall->name }} · {{ $order->stall->location }}
            </p>
            <div class="inline-flex items-center gap-2 mt-4 bg-white/15 rounded-full px-4 py-2 text-xs font-bold relative">
                <i class="fa-solid fa-clock"></i> Jadwal: {{ $order->pickup_slot_label }}
            </div>
        </div>

        {{-- Order summary --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-900">Ringkasan Pesanan</h3>
                <a href="{{ route('orders.show', $order) }}" class="text-xs font-semibold text-emerald-600 hover:underline">
                    Lacak Pesanan <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4 mb-4 flex items-center justify-between">
                <div>
                    <p class="text-[11px] text-gray-400">No. Pesanan</p>
                    <p class="text-sm font-bold text-gray-800 font-mono">{{ $order->order_number }}</p>
                </div>
                <span class="bg-sunshine-400 text-gray-900 text-[10px] font-bold px-3 py-1.5 rounded-full">
                    {{ $order->status_label }}
                </span>
            </div>

            <div class="space-y-3">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                            <img src="{{ $item->menu_image }}" alt="{{ $item->menu_name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">{{ $item->menu_name }}</p>
                            <p class="text-[11px] text-gray-400">Rp{{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}</p>
                        </div>
                        <span class="text-sm font-bold text-gray-800">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center border-t border-gray-100 pt-4 mt-4 font-extrabold text-gray-900">
                <span class="text-sm">Total</span>
                <span class="text-mint-600">{{ $order->total_amount_formatted }}</span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <a href="{{ route('orders.show', $order) }}"
               class="flex items-center justify-center gap-2 bg-mint-400 hover:bg-mint-500 text-white font-bold text-sm py-3.5 rounded-xl shadow-md shadow-emerald-500/20 transition">
                <i class="fa-solid fa-location-crosshairs"></i> Lacak Real-Time
            </a>
            <a href="{{ route('canteen.menu') }}"
               class="flex items-center justify-center gap-2 bg-white border border-gray-200 hover:border-emerald-300 text-gray-700 font-bold text-sm py-3.5 rounded-xl transition">
                <i class="fa-solid fa-plus text-emerald-500"></i> Pesan Lagi
            </a>
        </div>
    </div>
@endsection