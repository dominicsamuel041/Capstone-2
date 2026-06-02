@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="flex min-h-screen items-center justify-center py-10">
    <div class="w-full max-w-md">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="logo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang</h1>
            <p class="text-indigo-200/70 mt-1.5 text-sm">Sistem Manajemen Aset & BHP Laboratorium</p>
        </div>

        {{-- Card --}}
        <div class="glass-card p-8">
            <h2 class="text-xl font-bold text-white mb-1">Masuk ke Akun Anda</h2>
            <p class="text-slate-400 text-sm mb-6">Masukkan email dan password Anda untuk melanjutkan.</p>

            {{-- Session Status --}}
            @if(session('status'))
                <div class="error-msg mb-4" style="background:rgba(34,197,94,0.15); border-color:rgba(34,197,94,0.35); color:#86efac;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="input-label">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="input-field @error('email') border-red-500/60 @enderror"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <p class="mt-1.5 text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="input-label">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="input-field @error('password') border-red-500/60 @enderror"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="mt-1.5 text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded accent-indigo-500"
                    >
                    <label for="remember" class="text-slate-300 text-sm select-none cursor-pointer">Ingat saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-primary mt-2">
                    Masuk ke Sistem
                </button>
            </form>

            <hr class="divider mt-6">

            <p class="text-center text-slate-400 text-sm">
                Belum punya akun?
                <a href="{{ route('register') }}" class="link-accent ml-1">Daftar Sekarang</a>
            </p>
        </div>

        {{-- Footer --}}
        <p class="text-center text-slate-600 text-xs mt-6">
            &copy; {{ date('Y') }} Sistem Informasi Laboratorium — Capstone Project
        </p>
    </div>
</div>
@endsection
