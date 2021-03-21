<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FullStack DEVELOPER</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('css/transparent/app.min.css') }}" rel="stylesheet" />
</head>
<body class="pace-top bg-black-darker">
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <div id="page-container" class="fade page-container">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/theme/transparent.min.js') }}"></script>
</body>
</html>