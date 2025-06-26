<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Galon Rebus') }}</title>
   @vite('resources/css/app.css')
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2933/2933884.png" type="image/png">

    @stack('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-100 via-blue-200 to-cyan-200 flex flex-col">
    <main class="flex-1 flex items-center justify-center">
        @yield('content')
    </main>
    <footer class="w-full py-4 bg-white/60 text-center text-sm text-blue-800 mt-8 shadow-inner">
        &copy; {{ date('Y') }} Galon Rebus. All rights reserved.
    </footer>
    @stack('scripts')
</body>
</html>
