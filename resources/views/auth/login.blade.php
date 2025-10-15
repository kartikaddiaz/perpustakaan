<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>
<body>
    <div class="header-shape"></div>

    <div class="auth-container">
        <h1>Selamat Datang!</h1>
        <p>Masuk ke akun Anda</p>

        <!-- Pesan error -->
        @if ($errors->any())
            <div class="error-msg">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">

            <label for="password">Sandi</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-submit">MASUK</button>
        </form>

        <p class="register-text">Belum punya akun?
            <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
