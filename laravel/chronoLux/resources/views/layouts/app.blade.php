<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <link rel="icon" href="IMGs/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Header CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <!-- Footer CSS -->
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/successModal.css') }}">
    <!-- Extra CSS for concrete subpages -->
    @stack('styles')
</head>
<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')

     <!-- JavaScript -->
     <script src="{{ asset('js/script.js') }}"></script>
     <script src="{{ asset('js/searchScript.js') }}"></script>

     <!-- Extra JS for concrete subpages -->
     @stack('scripts')
</body>
</html>