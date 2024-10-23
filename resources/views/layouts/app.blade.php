<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CUCSH') }}</title>

    <!-- Fonts -->
    <link rel="icon" href=" {{ asset('img/udg1.webp') }} ">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('build/assets/app.css')}}">

    <!-- Styles -->
    <style>
        body {
            background: url("https://tse4.mm.bing.net/th?id=OIP.AmjCR1h1J_u7lBClC2J0HwAAAA&pid=Api&P=0&h=180") no-repeat center center fixed;
            background-size: contain;
            margin: 0;
            padding: 0;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.7);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .overlay h1 {
            font-size: 3rem;
            color: #fff;
            margin-bottom: 1rem;
        }

        .overlay p {
            font-size: 1.2rem;
            color: #dcdcdc;
            margin-bottom: 2rem;
        }

        .overlay .btn {
            padding: 10px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
        }

        .btn-light {
            background-color: #fff;
            color: #333;
            border: none;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .back-link {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .back-link a {
            font-size: 1rem;
            color: #fff;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
