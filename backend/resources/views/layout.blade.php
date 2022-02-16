<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Sadrinas">
    <title> Example </title>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    @yield('component')
</div>
</body>
</html>
