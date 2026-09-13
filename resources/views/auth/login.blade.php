@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-mint-400 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-md mx-auto mb-4">
                <i class="fa-solid fa-utensils"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-900">Masuk ke BiteGo</h2>
            <p class="text-xs text-gray-400 mt-1">Senang melihatmu kembali! 👋</p>
        </div>

        <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="nama@bitego.test"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
                @error('email')
                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-xs text-gray-500">
                    <input type="checkbox" name="remember" class="rounded text-emerald-500 focus:ring-emerald-500">
                    Ingat saya
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-mint-400 hover:bg-mint-500 text-white font-bold text-sm py-3 rounded-xl shadow-md shadow-emerald-500/20 transition">
                Masuk
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">Belum punya akun?</p>
            <a href="{{ route('auth.register', request('redirect') ? ['redirect' => request('redirect')] : []) }}"
               class="inline-block mt-2 text-sm font-bold text-emerald-600 hover:underline">
                Buat Akun Baru <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>
    </div>

    <div class="mt-5 bg-mint-50 border border-mint-200 rounded-2xl p-4 text-center text-xs text-gray-500">
        <p class="font-bold text-mint-700 mb-1">Akun demo siap pakai:</p>
        <p class="mb-1">Siswa: <code class="bg-white px-1.5 py-0.5 rounded">galih@bitego.test</code> / <code class="bg-white px-1.5 py-0.5 rounded">password</code></p>
        <p>Penjual: <code class="bg-white px-1.5 py-0.5 rounded">daniel@bitego.test</code> / <code class="bg-white px-1.5 py-0.5 rounded">password</code></p>
    </div>
</div>
@endsection