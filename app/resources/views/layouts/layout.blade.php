<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '在庫管理アプリ') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome (for home icon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 10vh;
            padding-bottom: 10vh;
        }
    </style>
</head>
<body>

    <!-- ヘッダー（固定） -->
    <header class="bg-info text-white py-2 px-4 shadow-sm position-fixed top-0 w-100" style="height: 10vh; z-index: 1030;">
        <div class="container d-flex justify-content-between align-items-center h-100">
            <div></div>
            <h2 class="m-0 text-center flex-grow-1 text-white">在庫管理アプリ</h2>
            <div class="text-end">
                @auth
                    {{ Auth::user()->name }} /
                    <a href="{{ route('logout') }}" class="text-white text-decoration-underline"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- メイン -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- フッター（固定） -->
    <footer class="bg-info py-3 position-fixed bottom-0 w-100 shadow-sm" style="height: 10vh; z-index: 1030;">
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-white">
                <i class="fas fa-home fa-3x"></i>
            </a>
        </div>
    </footer>

</body>
</html>
