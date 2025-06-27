<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Depot Air Minum</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="h-screen flex flex-col md:flex-row">
        <!-- Header (Mobile Only) -->
        <div class="md:hidden flex items-center justify-between bg-blue-600 text-white p-4">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <button @click="sidebarOpen = true" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
        <!-- Sidebar -->
        <div :class="{'block': sidebarOpen, 'hidden': !sidebarOpen}" class="fixed inset-0 z-40 bg-black bg-opacity-40 transition-opacity md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false"></div>
        <div :class="{'-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen}" class="fixed z-50 inset-y-0 left-0 w-64 bg-blue-600 text-white p-4 transform transition-transform duration-200 ease-in-out md:static md:translate-x-0 md:block md:w-64">
            <div class="flex items-center justify-between mb-6 md:block">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <button @click="sidebarOpen = false" class="md:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }} block p-3 rounded hover:bg-blue-700">
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.products') }}"
                       class="{{ request()->routeIs('admin.products*') ? 'bg-blue-700' : '' }} block p-3 rounded hover:bg-blue-700">
                        Produk
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.orders') }}"
                       class="{{ request()->routeIs('admin.orders*') ? 'bg-blue-700' : '' }} block p-3 rounded hover:bg-blue-700">
                        Pesanan
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.promotions') }}"
                       class="{{ request()->routeIs('admin.promotions*') ? 'bg-blue-700' : '' }} block p-3 rounded hover:bg-blue-700">
                        Promosi
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.news.index') }}"
                       class="{{ request()->routeIs('admin.news*') ? 'bg-blue-700' : '' }} block p-3 rounded hover:bg-blue-700">
                        Berita/Informasi
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.reports.index') }}"
                       class="{{ request()->routeIs('admin.reports*') ? 'bg-blue-700' : '' }} block p-3 rounded hover:bg-blue-700">
                        Laporan
                    </a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white p-3 rounded flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
        <!-- Content -->
        <div class="flex-1 p-6 overflow-y-auto md:ml-0 mt-0">
            @yield('content')
        </div>
    </div>
</body>
</html>
