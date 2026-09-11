@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-sunshine-400 text-gray-900 rounded-2xl flex items-center justify-center text-2xl font-bold shadow-md mx-auto mb-4">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-900">Buat Akun BiteGo</h2>
            <p class="text-xs text-gray-400 mt-1">Satu langkah lagi menuju bebas antre! 🚀</p>
        </div>

        <form method="POST" action="{{ route('auth.register') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           placeholder="Nama kamu"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
                @error('name')
                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">NIS</label>
                    <input type="text" name="nis" value="{{ old('nis') }}" placeholder="2024XXXX"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="XI MIPA 1"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required
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
                    <input type="password" name="password" required placeholder="Minimal 8 karakter"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
                @error('password')
                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Ulangi Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition">
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-mint-400 hover:bg-mint-500 text-white font-bold text-sm py-3 rounded-xl shadow-md shadow-emerald-500/20 transition">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">Sudah punya akun?</p>
            <a href="{{ route('auth.login') }}"
               class="inline-block mt-2 text-sm font-bold text-emerald-600 hover:underline">
                Masuk di sini <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>
    </div>
</div>
@endsection