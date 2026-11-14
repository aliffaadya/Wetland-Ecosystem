
<x-guest-layout>
    @section('title', 'Masuk')

    <h1>Selamat datang kembali</h1>
    <p>Masuk untuk melanjutkan perjalanan belajarmu.</p>

    <x-auth-session-status class="mt-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Kata sandi</label>
            <input
                id="password"
                type="password"
                name="password"
                placeholder="Masukkan kata sandi"
                required
                autocomplete="current-password"
            >
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-top: 16px;">
            <label style="display:flex;align-items:center;gap:8px;margin:0;font-weight:400;">
                <input type="checkbox" name="remember">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="button button-primary full">
            Masuk
        </button>
    </form>

    <p style="margin-top:22px;">
        Belum punya akun?
        <a class="auth-link" href="{{ route('register') }}">Daftar di sini</a>
    </p>
</x-guest-layout>
