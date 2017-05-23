<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex,nofollow">
        <title>WASP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/ico" href="/images/favicon.ico"/>
        <link rel="stylesheet" href="{{ URL::asset('css/sidebar.css') }}" type="text/css" />

        @include('template.css')
        @yield('head')
    </head>

    <body>

        @include('template.header')

        @include('template.navigation')

        @include('template.body_no_sidebar')

        @include('template.footer')

        @include('template.javascript')

    </body>
</html>
