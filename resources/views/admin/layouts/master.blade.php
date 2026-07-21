<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    @include('admin.layouts.head-tag')
    @yield('head-tag')
</head>
<body id="admin-body" class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    @include('admin.layouts.header')

    <div class="body-container flex min-h-[calc(100vh-5rem)]">
        @include('admin.layouts.sidebar')

        <main id="main-body" class="min-h-[calc(100vh-5rem)] flex-1 bg-slate-100 px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto w-full max-w-7xl">
                @yield('content')
            </div>
        </main>
    </div>

    @include('admin.layouts.scripts')
    @yield('script')

    @include('admin.layouts.notifications')
</body>
</html>
