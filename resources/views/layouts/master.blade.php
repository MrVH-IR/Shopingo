<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/master.css') }}">
</head>

<body>
  <div class="svg-container">
    <svg viewbox="0 0 800 400" class="svg">
      <path id="curve" fill="#50c6d8" d="M 800 300 Q 400 350 0 300 L 0 0 L 800 0 L 800 300 Z">
      </path>
    </svg>
  </div>

    @include('layouts.header')

  <main>
    <p>And the main section.</p>
    @yield('content')
  </main>

    @include('layouts.footer')
  <script type="text/javascript" href="{{ url('/js/master.js') }}"></script>
</body>


</html>