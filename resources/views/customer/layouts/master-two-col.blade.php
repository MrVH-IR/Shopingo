<!DOCTYPE html>
<html lang="en">
    <head>
        @include('customer.layouts.head-tag')
        @yield('head-tag')
    </head>
    <body>

    @include('customer.layouts.header')
    <section class="container-xxl body-container">
        @include('customer.layouts.sidebar')
    </section>
    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>
    <section class="toast-wrapper flex-row-reverse">
        @include('admin.alerts.toast.success')
        @include('admin.alerts.toast.error')
    </section>
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.error')
    @include('customer.layouts.footer')
    @include('customer.layouts.script')
    @yield('script')
    </body>
</html>
