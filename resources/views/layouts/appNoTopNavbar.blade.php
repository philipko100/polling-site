<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RateMyFigures') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- login -->
    <link href="{{ asset('css/auth/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <!-- if the page is pages profile or pages.show -->
    @if(isset($profile))
        <link href="{{ asset('css/pagesShow/base.css') }}" rel="stylesheet">
        <link href="{{ asset('css/pagesShow/flexbox.css') }}" rel="stylesheet">
    @endif


</head>
<body>
    <div id="app">
        <!-- no navbar included -->
        @include('inc.messages')
            <main class="py-4">
                @yield('content')
            </main>
    </div>

    <footer class="main-footer" style="background-color: #112D41; color: white;">
            <span>&copy;2019 {{ config('app.name', 'RateMyFigures') }}</span>
     </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
        <script>
           CKEDITOR.replace( 'summary-ckeditor' );
        </script>
</body>
</html>
