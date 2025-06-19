<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Depot Air Minum</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-600 text-white p-4">
            <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }} 
                       block p-3 rounded hover:bg-blue-700">
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.products') }}" 
                       class="{{ request()->routeIs('admin.products*') ? 'bg-blue-700' : '' }} 
                       block p-3 rounded hover:bg-blue-700">
                        Produk
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.orders') }}" 
                       class="{{ request()->routeIs('admin.orders*') ? 'bg-blue-700' : '' }} 
                       block p-3 rounded hover:bg-blue-700">
                        Pesanan
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.promotions') }}" 
                       class="{{ request()->routeIs('admin.promotions*') ? 'bg-blue-700' : '' }} 
                       block p-3 rounded hover:bg-blue-700">
                        Promosi
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </div>
    </div>
</body>
</html>