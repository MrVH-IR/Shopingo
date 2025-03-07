<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

    <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
        <h2 class="text-xl font-bold">پنل مدیریت</h2>
        <ul class="mt-4">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-gray-700">📊 داشبورد</a>
                <ul class="ml-4">
                    <li>
                        <a href="{{ route('admin.products') }}" class="block p-2 hover:bg-gray-600">📦 مدیریت محصولات</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>

        <main class="flex-1 p-6">
            @yield('content')
            @livewireScripts
        </main>
    </div>

</body>
