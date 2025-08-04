<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name' , 'FAQ') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @yield('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles()
</head>

<body>
    @include('informations.header')
    @yield('content')
    

    @include('informations.footer')
    @livewireScripts()
</body>