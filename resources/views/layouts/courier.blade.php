<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Kurir') - Galon Project</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-assigned { background: #cce5ff; color: #004085; }
        .status-picked_up { background: #d4edda; color: #155724; }
        .status-on_way { background: #d1ecf1; color: #0c5460; }
        .status-delivered { background: #d4edda; color: #155724; }
        .status-failed { background: #f8d7da; color: #721c24; }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Responsive Sidebar */
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 260px;
                height: 100vh;
                z-index: 1045;
                transform: translateX(-100%);
                box-shadow: 2px 0 8px rgba(0,0,0,0.08);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.3);
                z-index: 1040;
            }
            .sidebar-backdrop.show {
                display: block;
            }
            .main-content {
                padding-left: 0 !important;
            }
        }
        @media (min-width: 992px) {
            .sidebar {
                position: static;
                width: 100%;
                transform: none !important;
                box-shadow: none;
            }
            .sidebar-backdrop {
                display: none !important;
            }
        }
        /* Sidebar toggle button */
        .sidebar-toggle {
            display: none;
        }
        @media (max-width: 991.98px) {
            .sidebar-toggle {
                display: inline-block;
                background: none;
                border: none;
                font-size: 1.5rem;
                color: #667eea;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3" id="sidebarMenu">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-center">
                            <h4 class="text-white mb-0">
                                <i class="fas fa-truck me-2"></i>
                                Kurir Panel
                            </h4>
                            <small class="text-white-50">{{ Auth::user()->name }}</small>
                        </div>
                        <button class="btn btn-outline-light d-lg-none" id="closeSidebarBtn" style="font-size:1.2rem;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('courier.dashboard') ? 'active' : '' }}"
                           href="{{ route('courier.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('courier.deliveries') ? 'active' : '' }}"
                           href="{{ route('courier.deliveries') }}">
                            <i class="fas fa-list me-2"></i>
                            Semua Pengiriman
                        </a>
                        <a class="nav-link {{ request()->routeIs('courier.available-deliveries') ? 'active' : '' }}"
                           href="{{ route('courier.available-deliveries') }}">
                            <i class="fas fa-plus-circle me-2"></i>
                            Pengiriman Tersedia
                        </a>
                        <a class="nav-link {{ request()->routeIs('courier.delivery-history') ? 'active' : '' }}"
                           href="{{ route('courier.delivery-history') }}">
                            <i class="fas fa-history me-2"></i>
                            Riwayat Pengiriman
                        </a>
                        <a class="nav-link {{ request()->routeIs('courier.profile') ? 'active' : '' }}"
                           href="{{ route('courier.profile') }}">
                            <i class="fas fa-user-cog me-2"></i>
                            Profil
                        </a>
                        <hr class="text-white-50">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                    </nav>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <button class="sidebar-toggle d-lg-none me-2" id="openSidebarBtn">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div>
                                <h2 class="mb-0">@yield('title', 'Dashboard')</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('courier.dashboard') }}">Kurir</a></li>
                                        @yield('breadcrumb')
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <!-- Notifications -->
                            <div class="dropdown me-3">
                                <button class="btn btn-outline-primary position-relative" type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-bell"></i>
                                    @if(Auth::user()->notifications()->where('is_read', false)->count() > 0)
                                        <span class="notification-badge">
                                            {{ Auth::user()->notifications()->where('is_read', false)->count() }}
                                        </span>
                                    @endif
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                                    <li><h6 class="dropdown-header">Notifikasi</h6></li>
                                    @forelse(Auth::user()->notifications()->where('is_read', false)->take(5)->get() as $notification)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                               onclick="markAsRead({{ $notification->id }})">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold">{{ $notification->title }}</div>
                                                        <small class="text-muted">{{ $notification->message }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item-text">Tidak ada notifikasi baru</span></li>
                                    @endforelse
                                </ul>
                            </div>
                            <!-- User Menu -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-1"></i>
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('courier.profile') }}"><i class="fas fa-user-cog me-2"></i>Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function markAsRead(notificationId) {
            $.ajax({
                url: '/courier/notifications/' + notificationId + '/mark-read',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    }
                }
            });
        }
        // Sidebar responsive toggle
        const sidebarMenu = document.getElementById('sidebarMenu');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const openSidebarBtn = document.getElementById('openSidebarBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        if(openSidebarBtn && sidebarMenu && sidebarBackdrop) {
            openSidebarBtn.addEventListener('click', function() {
                sidebarMenu.classList.add('show');
                sidebarBackdrop.classList.add('show');
            });
            closeSidebarBtn.addEventListener('click', function() {
                sidebarMenu.classList.remove('show');
                sidebarBackdrop.classList.remove('show');
            });
            sidebarBackdrop.addEventListener('click', function() {
                sidebarMenu.classList.remove('show');
                sidebarBackdrop.classList.remove('show');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
