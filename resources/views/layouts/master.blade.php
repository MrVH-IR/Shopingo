<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Home')</title>
    @yield('head')
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ url('/css/master.css') }}"
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800 font-sans relative">
    <!-- Header placed above -->
    <header class="bg-blue-500 text-white py-12 absolute inset-x-0 top-0 z-10">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold">Welcome to Our Store</h1>
            <p class="text-lg mt-2">Discover products and scroll to explore!</p>
        </div>
        <a href="/your-link-here" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 hover:scale-105 transition-transform">
            <img src="{{ url('/images/menu/Shopingo_Menu_Icon_1.gif') }}"
                 alt="Menu Icon"
                 class="w-12 h-12 object-contain"> <!-- Fixed size and containment -->
        </a>
    </header>

    <!-- SVG Positioned Under Header -->
    <div class="svg-container w-full pt-36">
        <svg viewbox="0 0 800 400" class="w-full">
            <path id="curve" fill="#50c6d8" d="M 800 300 Q 400 350 0 300 L 0 0 L 800 0 L 800 300 Z"></path>
        </svg>
    </div>

    <main class="pt-24">
        @yield('content')
    </main>

    @include('layouts.footer')
    <script type="text/javascript" src="{{ url('/js/master.js') }}"></script>
</body>

</html>
