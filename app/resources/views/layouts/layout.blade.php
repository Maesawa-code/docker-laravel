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
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- ヘッダー -->
    <header class="bg-info text-white py-2 px-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
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
    <main class="container flex-grow-1 py-4">
        @yield('content')
    </main>

    <!-- フッター -->
    <footer class="bg-info py-3 mt-auto shadow-sm">
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-white">
                <i class="fas fa-home fa-lg"></i>
            </a>
        </div>
    </footer>

</body>
</html>
