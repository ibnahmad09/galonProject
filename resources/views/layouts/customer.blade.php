<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot Air Minum Rebus</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('customer.dashboard') }}" class="text-white text-2xl font-bold">Depot Air Minum</a>

            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <div class="relative">
                    <a href="{{ route('customer.cart') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM4 9a1 1 0 00-1 1v4a1 1 0 102 0v-4a1 1 0 00-1-1zm-1 14a2 2 0 104 0h-5a2 2 0 00-2 2v1a2 2 0 002 2h5a2 2 0 002-2v-1a2 2 0 00-2-2h-5z" />
                        </svg>
                        @php $cartCount = count(session('cart', [])) @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                </div>
                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center p-4 mt-8">
        &copy; 2024 Depot Air Minum Rebus
    </footer>
</body>
</html>