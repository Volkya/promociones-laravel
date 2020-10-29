<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Promociones manager</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
    </head>
    <body>
        @include("layouts.menu")
        <div class="header">
            @yield("head")
        </div>
        <div class="container py-5">
            @yield("formagic")
        </div>
        <div class="footer">
            @yield("pie")
        </div>

        





    </body>
</html>
