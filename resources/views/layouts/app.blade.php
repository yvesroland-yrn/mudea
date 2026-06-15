{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MUDEA – Mutuelle de Développement d\'Andé')</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/mudea-favicon.ico') }}" type="image/x-icon">

    {{-- CSS/JS compilés --}}
    <link rel="stylesheet" href="{{ asset('css/mudea-header-footer.css') }}">

    {{-- Styles supplémentaires par page --}}
    @stack('styles')
</head>
<body>

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- CONTENU PRINCIPAL --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    {{-- JS principal --}}
    <script src="{{ asset('js/mudea-header.js') }}"></script>

    {{-- Scripts supplémentaires par page --}}
    @stack('scripts')
</body>
</html>
