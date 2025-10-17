<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="header-shape"></div>

    <div class="auth-container">
        <h1>Reset Password</h1>
        <p>Masukkan sandi baru Anda</p>

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

        <!-- Pesan sukses -->
        @if (session('status'))
            <div class="alert alert-success" style="font-size:14px; text-align:left; border-radius:8px;">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form reset password -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">

            <label for="password">Sandi Baru</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">

            <label for="password_confirmation">Konfirmasi Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">

            <button type="submit" class="btn-submit">RESET PASSWORD</button>
        </form>

        <p class="register-text">Sudah ingat sandi?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</body>
</html>
