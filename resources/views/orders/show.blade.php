@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <p class="text-[11px] text-gray-400 font-semibold uppercase tracking-wide">No. Pesanan</p>
                <h2 class="text-lg font-extrabold text-gray-900 font-mono">{{ $order->order_number }}</h2>
                <p class="text-xs text-gray-400 mt-1">
                    <i class="fa-solid fa-store text-emerald-400 mr-1"></i>{{ $order->stall->name }}
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-center">
                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wide">Kode Ambi</p>
                    <p class="font-mono text-2xl font-extrabold text-mint-600 tracking-[0.2em]">{{ $order->pickup_code }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wide">Jadwal</p>
                    <p class="text-sm font-bold text-gray-800">{{ $order->pickup_slot_label }}</p>
                </div>
            </div>
        </div>

        {{-- Status tracker --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-6">
            <h3 class="text-sm font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-route text-emerald-500"></i> Status Pesanan
            </h3>

            @php
                $steps = [
                    'menunggu' => ['Menunggu', 'Pesanan masuk dan menunggu diproses penjual.', 'fa-regular fa-clock'],
                    'dimasak' => ['Dimasak', 'Penjual sedang menyiapkan pesananmu.', 'fa-solid fa-fire'],
                    'siap_ambil' => ['Siap Ambil', 'Pesanan siap! Ambil di Express Pickup.', 'fa-solid fa-bolt'],
                    'selesai' => ['Selesai', 'Pesanan sudah diambil. Selamat menikmati!', 'fa-solid fa-circle-check'],
                ];
                if ($order->status === 'dibatalkan') {
                    $steps = ['dibatalkan' => ['Dibatalkan', 'Pesanan dibatalkan.', 'fa-solid fa-circle-xmark']];
                }
                $stepKeys = array_keys($steps);
                $currentIndex = array_search($order->status, $stepKeys);
                $done = $currentIndex > 0;
            @endphp

            <div class="space-y-0 relative">
                @foreach ($steps as $key => [$label, $desc, $icon])
                    @php
                        $active = $key === $order->status;
                        $completed = array_search($key, $stepKeys) < $currentIndex || ($order->status === 'selesai' && $key !== 'selesai');
                    @endphp
                    <div class="flex items-start gap-4 relative pb-8 last:pb-0">
                        @if (! $loop->last)
                            <div class="absolute left-[19px] top-10 bottom-0 w-0.5 {{ $completed ? 'bg-emerald-400' : 'bg-gray-200' }}"></div>
                        @endif
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 relative z-10 text-sm
                            {{ $active ? 'bg-mint-400 text-white shadow-lg shadow-emerald-500/30' : ($completed ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400') }}">
                            @if ($completed)
                                <i class="fa-solid fa-check"></i>
                            @else
                                <i class="{{ $icon }}"></i>
                            @endif
                        </div>
                        <div class="pt-1.5">
                            <p class="font-bold text-sm {{ $active ? 'text-mint-700' : ($completed ? 'text-gray-600' : 'text-gray-400') }}">
                                {{ $label }}
                                @if ($active)
                                    <span class="ml-2 inline-flex items-center gap-1 text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-sunshine-400 text-gray-900">
                                        <i class="fa-solid fa-circle text-[5px] animate-pulse"></i> Terkini
                                    </span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($order->status !== 'dibatalkan')
                <div class="mt-4 bg-mint-50 border border-emerald-100 rounded-2xl p-4 flex items-start gap-3">
                    <i class="fa-solid fa-lightbulb text-sunshine-500 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-bold text-gray-700">Tips Express Pickup</p>
                        <p class="text-[11px] text-gray-500 mt-0.5 leading-relaxed">
                            Tunjukkan kode <span class="font-mono font-bold text-mint-600">{{ $order->pickup_code }}</span> kepada penjual di konter
                            <span class="font-semibold">{{ $order->stall->location }}</span>.
                            Biasanya siap dalam 5–10 menit sebelum istirahat.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Items --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-6">
            <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-basket-shopping text-emerald-500"></i> Rincian Pesanan
            </h3>
            <div class="space-y-3 mb-4">
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
            @if ($order->notes)
                <div class="bg-gray-50 rounded-xl p-3.5 text-xs text-gray-500 mb-4">
                    <span class="font-bold text-gray-600">Catatan:</span> {{ $order->notes }}
                </div>
            @endif
            <div class="flex justify-between items-center border-t border-gray-100 pt-4 font-extrabold text-gray-900">
                <span class="text-sm">Total</span>
                <span class="text-mint-600">{{ $order->total_amount_formatted }}</span>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-emerald-300 text-gray-700 font-bold text-sm px-5 py-3 rounded-xl transition">
                <i class="fa-solid fa-arrow-left text-emerald-500"></i> Kembali
            </a>
            @if ($order->status === 'menunggu')
                <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline-flex" onsubmit="return confirm('Yakin batalkan pesanan ini?')">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 font-bold text-sm px-5 py-3 rounded-xl transition">
                        <i class="fa-solid fa-xmark"></i> Batalkan Pesanan
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection