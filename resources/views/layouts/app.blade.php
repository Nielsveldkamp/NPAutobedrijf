<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
    .min-h-eightyPscreen{
        min-height: 80vh;
    }
</style>
</head>

<body class="font-sans antialiased">
    <div style="height:100%; width: 182px; position: absolute; right:0px; background-color: #C9CAD9; z-index:-1;"></div>
    <div class="">
        @include('layouts.navigation')

        <main>
            {{ $slot }}
        </main>
        
        <x-footer> </x-footer>
    </div>
</body>

</html>
