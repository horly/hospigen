<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities."/>
        <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app"/>
        <meta name="author" content="pixelstrap"/>

        <title>{{ config('app.name') }} - @yield('title')</title>

        <!-- Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""/>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap" rel="stylesheet"/>

        <!-- Favicon icon-->

        <link rel="icon" href="assets/images/icon1.png" type="image/x-icon"/>
        <link rel="shortcut icon" href="assets/images/icon1.png" type="image/x-icon"/>


        <link rel="stylesheet" href="{{ asset('assets/app.css') }}">


    </head>
    <body>


        {{-- Tout nos contenues seront affiché ici --}}
        @yield('content')

        @include('global.datatable')

        @include('global.sweetalert-message')

    </body>
</html>
