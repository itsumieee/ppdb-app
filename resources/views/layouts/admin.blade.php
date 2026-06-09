<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin PPDB | @yield('title')</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin: 4px 12px;
            border-radius: 12px;
            color: #475569;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .sidebar-item i {
            width: 24px;
            font-size: 1.2rem;
        }
        .sidebar-item:hover {
            background: linear-gradient(95deg, #eff6ff, #e0e7ff);
            color: #1e40af;
        }
        .sidebar-item.active {
            background: linear-gradient(95deg, #2563eb, #1e40af);
            color: white;
            box-shadow: 0 8px 16px -4px rgba(37,99,235,0.2);
        }
        .sidebar-item.active i {
            color: white;
        }
        .card-dashboard {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            border: 1px solid #f0f2f5;
        }
        .stat-card {
            background: white;
            border-radius: 1.25rem;
            border-left: 4px solid;
            transition: all 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">
        <!-- Sidebar Modern -->
        <aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-white shadow-xl border-r border-gray-100 transition-all duration-300 flex flex-col z-30">
            <!-- Logo & Toggle -->
            <div class="p-5 flex items-center justify-between border-b border-gray-100">
                <div x-show="sidebarOpen" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-graduation-cap text-white text-sm"></i>
                    </div>
                    <span class="font-extrabold text-xl bg-gradient-to-r from-blue-700 to-indigo-700 bg-clip-text text-transparent">Admin PPDB</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto py-6">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span x-show="sidebarOpen">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.pendaftar.index') }}" class="sidebar-item {{ request()->routeIs('admin.pendaftar*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span x-show="sidebarOpen">Pendaftar</span>
                    </a>
                    <a href="{{ route('admin.verifikasi.index') }}" class="sidebar-item {{ request()->routeIs('admin.verifikasi*') ? 'active' : '' }}">
                        <i class="fas fa-check-double"></i>
                        <span x-show="sidebarOpen">Verifikasi Berkas</span>
                    </a>
                    <a href="{{ route('admin.jurusan.index') }}" class="sidebar-item {{ request()->routeIs('admin.jurusan*') ? 'active' : '' }}">
                        <i class="fas fa-book-open"></i>
                        <span x-show="sidebarOpen">Jurusan</span>
                    </a>
                    <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-item {{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i>
                        <span x-show="sidebarOpen">Pengumuman</span>
                    </a>
                    <a href="{{ route('admin.jadwal.index') }}" class="sidebar-item {{ request()->routeIs('admin.jadwal*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span x-show="sidebarOpen">Jadwal PPDB</span>
                    </a>
                    <a href="{{ route('admin.profil_sekolah.edit') }}" class="sidebar-item {{ request()->routeIs('admin.profil_sekolah*') ? 'active' : '' }}">
                        <i class="fas fa-school"></i>
                        <span x-show="sidebarOpen">Profil Sekolah</span>
                    </a>
                    <a href="{{ route('admin.galeri.index') }}" class="sidebar-item {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        <span x-show="sidebarOpen">Galeri</span>
                    </a>
                    <a href="{{ route('admin.laporan.index') }}" class="sidebar-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span x-show="sidebarOpen">Laporan</span>
                    </a>
                    <a href="{{ route('admin.pengaturan.index') }}" class="sidebar-item {{ request()->routeIs('admin.pengaturan*') ? 'active' : '' }}">
                        <i class="fas fa-sliders-h"></i>
                        <span x-show="sidebarOpen">Pengaturan</span>
                    </a>
                    <a href="{{ route('admin.akun.index') }}" class="sidebar-item {{ request()->routeIs('admin.akun*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i>
                        <span x-show="sidebarOpen">Akun Saya</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="sidebar-item w-full text-left">
                            <i class="fas fa-sign-out-alt"></i>
                            <span x-show="sidebarOpen">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- User Profile (bawah sidebar) -->
            <div x-show="sidebarOpen" class="p-4 border-t border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-10 border-b border-gray-100 px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
            </header>
            <main class="p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>
</html>