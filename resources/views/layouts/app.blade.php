<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyAdmin')</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #1a1a1a 0%, #121212 100%);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 20px 25px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand h5 {
            margin-bottom: 0;
            font-weight: 600;
            font-size: 20px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 500;
            border-radius: 0;
            margin: 4px 0;
            position: relative;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 16px;
            width: 20px;
            text-align: center;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding-left: 30px;
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-left: 4px solid #ffffff;
        }

        .sidebar .nav-link.active i {
            color: #ffffff;
        }

        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }

        .content {
            flex: 1;
            padding: 20px;
            transition: all 0.3s;
        }

        .topbar {
            height: 70px;
            background: linear-gradient(135deg, #1a1a1a 0%, #121212 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .topbar .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.3rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .topbar .menu-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px 0;
        }

        .dropdown-item {
            padding: 10px 20px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                height: 100%;
            }

            .content {
                width: 100%;
            }
        }

        /* Add some nice styling for nav-item sections */
        .nav-section {
            padding: 8px 25px;
            font-size: 12px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 600;
            letter-spacing: 1px;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="menu-toggle btn" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <span class="ms-3 fw-semibold d-none d-md-inline">
                <img src="https://absensi.smktarunabhakti.net:3995/img/iluminati_tb.png" alt="Logo" style="height: 30px; max-width: 100%;">
            </span>
        </div>

        <div class="dropdown">
            <button class="btn text-white dropdown-toggle d-flex align-items-center gap-2" type="button"
                id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-lg"></i>
                <span>Admin</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h5 class="text-white">
                    <a href="{{ route('dashboard') }}" class="text-white" style="text-decoration: none;">
                        <img src="https://absensi.smktarunabhakti.net:3995/img/iluminati_tb.png" alt="Logo" style="height: 40px; max-width: 100%;">
                        <span class="ms-2">SARPRAS</span>
                    </a>
                </h5>
            </div>
            <div class="p-3">
                <div class="nav-section">Menu Utama</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori.index') }}"
                            class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                            <i class="fas fa-tags"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.barang.index') }}"
                            class="nav-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i>Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.stok.index') }}"
                            class="nav-link {{ request()->routeIs('admin.stok.*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>Stok
                        </a>
                    </li>
                </ul>

                <div class="nav-section">Transaksi</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.peminjaman.index') }}"
                            class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                            <i class="fas fa-hand-holding"></i>Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengembalian.index') }}"
                            class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                            <i class="fas fa-undo"></i>Pengembalian
                        </a>
                    </li>
                </ul>

                <div class="nav-section">Laporan</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.peminjaman') }}"
                           class="nav-link {{ request()->routeIs('admin.laporan.peminjaman') ? 'active' : '' }}">
                            <i class="fas fa-file-alt"></i>Laporan Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.pengembalian') }}"
                           class="nav-link {{ request()->routeIs('admin.laporan.pengembalian') ? 'active' : '' }}">
                            <i class="fas fa-file-contract"></i>Laporan Pengembalian
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        });
 // Highlight active menu based on current route
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>
</body>
@yield('scripts')

</html>