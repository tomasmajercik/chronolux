<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- Header CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <!-- Footer CSS -->
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <!-- Extra CSS pre konkrétne stránky -->
    @stack('styles')
</head>
<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')

     <!-- JavaScript -->
     <script src="{{ asset('js/script.js') }}"></script>
     <script src="{{ asset('js/searchScript.js') }}"></script>

     <!-- Extra JS pre konkrétne stránky -->
     @stack('scripts')
</body>
</html>