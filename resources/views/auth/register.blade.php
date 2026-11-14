
<x-guest-layout>
    @section('title', 'Daftar')

    <h1>Buat akun siswa</h1>
    <p>Daftar untuk memulai perjalanan belajar ekosistem lahan basah.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nama lengkap</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Masukkan nama lengkap"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                required
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
                placeholder="Minimal 8 karakter"
                required
                autocomplete="new-password"
            >
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi kata sandi</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder="Ulangi kata sandi"
                required
                autocomplete="new-password"
            >
        </div>

        <button type="submit" class="button button-primary full">
            Daftar Sekarang
        </button>
    </form>

    <p style="margin-top:22px;">
        Sudah punya akun?
        <a class="auth-link" href="{{ route('login') }}">Masuk di sini</a>
    </p>
</x-guest-layout>
