@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Pesanan Saya</h2>
            <p class="text-xs text-gray-500 mt-0.5">Pantau status pesananmu secara real-time.</p>
        </div>
        <a href="{{ route('canteen.menu') }}" class="inline-flex items-center gap-2 bg-mint-400 hover:bg-[#00A892] text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm transition">
            <i class="fa-solid fa-plus"></i> Pesan Menu
        </a>
    </div>

    <div class="space-y-4">
        @forelse ($orders as $order)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    {{-- Stall + order info --}}
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div class="w-14 h-14 rounded-2xl overflow-hidden shrink-0 bg-gray-100">
                            <img src="{{ $order->stall->image }}" alt="{{ $order->stall->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h4 class="font-bold text-sm text-gray-900">{{ $order->stall->name }}</h4>
                                <span class="text-[10px] text-gray-400 font-mono">{{ $order->order_number }}</span>
                            </div>
                            <p class="text-[11px] text-gray-400 mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-clock text-emerald-400"></i> {{ $order->pickup_slot_label }}
                            </p>
                            <p class="text-[11px] text-gray-400 mt-0.5 line-clamp-1">
                                {{ $order->items->pluck('menu_name')->implode(', ') }}
                            </p>
                        </div>
                    </div>

                    {{-- Pickup code + status --}}
                    <div class="flex items-center gap-5 md:gap-6 shrink-0">
                        <div class="text-center">
                            <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wide">Kode Ambil</p>
                            <p class="font-mono text-lg font-extrabold text-mint-600 tracking-widest">{{ $order->pickup_code }}</p>
                        </div>
                        @php
                            $color = match($order->status) {
                                'menunggu' => 'bg-gray-100 text-gray-600',
                                'dimasak' => 'bg-amber-100 text-amber-700',
                                'siap_ambil' => 'bg-emerald-500/15 text-emerald-700',
                                'selesai' => 'bg-mint-100 text-mint-700',
                                'dibatalkan' => 'bg-rose-100 text-rose-600',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="{{ $color }} text-[10px] font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1.5">
                            @if ($order->status === 'dimasak') <i class="fa-solid fa-fire text-[9px]"></i>
                            @elseif ($order->status === 'siap_ambil') <i class="fa-solid fa-bolt text-[9px]"></i>
                            @elseif ($order->status === 'menunggu') <i class="fa-regular fa-clock text-[9px]"></i>
                            @elseif ($order->status === 'selesai') <i class="fa-solid fa-check text-[9px]"></i>
                            @else <i class="fa-solid fa-xmark text-[9px]"></i>
                            @endif
                            {{ $order->status_label }}
                        </span>
                    </div>

                    {{-- Total + actions --}}
                    <div class="flex items-center justify-between gap-4 md:flex-col md:items-end shrink-0">
                        <span class="font-extrabold text-gray-900 text-sm">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        <div class="flex items-center gap-2">
                            @if ($order->status === 'menunggu')
                                <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?')">
                                    @csrf
                                    <button type="submit" class="text-[11px] text-rose-500 hover:text-rose-600 font-semibold border border-rose-200 hover:border-rose-300 px-3 py-1.5 rounded-lg transition">
                                        Batalkan
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('orders.show', $order) }}"
                               class="inline-flex items-center gap-1.5 bg-mint-400 hover:bg-[#00A892] text-white text-[11px] font-bold px-4 py-1.5 rounded-lg shadow-sm transition">
                                <i class="fa-solid fa-location-crosshairs text-[9px]"></i> Lacak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-14 text-center border border-dashed border-gray-200">
                <div class="w-20 h-20 bg-mint-50 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 text-mint-400">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Pesanan</h4>
                <p class="text-sm text-gray-400 mb-6">Yuk pesan menu favoritmu sekarang!</p>
                <a href="{{ route('canteen.menu') }}" class="inline-flex items-center gap-2 bg-mint-400 hover:bg-[#00A892] text-white text-xs font-bold px-6 py-3 rounded-full shadow-md shadow-emerald-500/20 transition">
                    <i class="fa-solid fa-utensils"></i> Jelajahi Menu
                </a>
            </div>
        @endforelse
    </div>
@endsection