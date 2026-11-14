
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Autentikasi') — Wetland Explorer</title>

    <link rel="stylesheet" href="{{ asset('css/wetland-landing.css') }}">

    <style>
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background: #f5f7ef;
        }

        .auth-card {
            width: min(460px, 100%);
            padding: 36px;
            border: 1px solid #dce5d8;
            border-radius: 24px;
            background: #fff;
            box-shadow: 0 24px 70px #284b3b16;
        }

        .auth-card h1 {
            font-size: 32px;
            letter-spacing: -1px;
            margin: 24px 0 8px;
            color: #284b3b;
        }

        .auth-card p {
            color: #647269;
        }

        .auth-card label {
            display: block;
            margin: 18px 0 6px;
            font-weight: 700;
            color: #284b3b;
        }

        .auth-card input:not([type="checkbox"]) {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd9c8;
            border-radius: 12px;
            font: inherit;
        }

        .auth-card button {
            cursor: pointer;
        }

        .auth-card .full {
            width: 100%;
            margin-top: 22px;
        }

        .auth-card .auth-link {
            color: #557b5b;
            font-weight: 700;
        }

        .auth-card .error {
            color: #b42318;
            font-size: 13px;
            margin-top: 5px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #557b5b;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <main class="auth-card">
        <a class="brand" href="{{ url('/') }}">
            <span class="brand-mark">♧</span>
            <span>Wetland Explorer</span>
        </a>

        {{ $slot }}

        <a class="back" href="{{ url('/') }}">
            ← Kembali ke Beranda
        </a>
    </main>
</body>
</html>
