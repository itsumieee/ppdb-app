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
            transition: all 0.2s ease;
            border-radius: 12px;
        }
        .sidebar-item:hover, .sidebar-item.active {
            background: linear-gradient(95deg, #eef2ff, #e0e7ff);
            color: #1e40af;
        }
        .sidebar-item i { width: 1.75rem; }
        .card-dashboard {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            border: 1px solid #f0f2f5;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.08);
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
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div x-data="{ sidebarOpen: window.innerWidth > 1024 }" class="flex h-screen overflow-hidden">
        <!-- SIDEBAR MODERN -->
        <aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-white shadow-lg border-r border-gray-100 transition-all duration-300 flex flex-col z-30">
            <div class="p-5 flex items-center justify-between border-b border-gray-100">
                <div x-show="sidebarOpen" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-sm"></i>
                    </div>
                    <span class="font-extrabold text-xl text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-indigo-700">Admin PPDB</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active bg-blue-50 text-blue-700' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.pendaftar.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.pendaftar*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Pendaftar</span>
                </a>
                <a href="{{ route('admin.verifikasi.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.verifikasi*') ? 'active' : '' }}">
                    <i class="fas fa-check-double w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Verifikasi Berkas</span>
                </a>
                <a href="{{ route('admin.jurusan.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.jurusan*') ? 'active' : '' }}">
                    <i class="fas fa-book-open w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Jurusan</span>
                </a>
                <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Pengumuman</span>
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.jadwal*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Jadwal PPDB</span>
                </a>
                <a href="{{ route('admin.profil_sekolah.edit') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.profil_sekolah*') ? 'active' : '' }}">
                    <i class="fas fa-school w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Profil Sekolah</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                    <i class="fas fa-images w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Galeri</span>
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Laporan</span>
                </a>
                <a href="{{ route('admin.pengaturan.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.pengaturan*') ? 'active' : '' }}">
                    <i class="fas fa-sliders-h w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Pengaturan</span>
                </a>
                <a href="{{ route('admin.akun.index') }}" class="sidebar-item flex items-center px-3 py-2.5 text-gray-700 {{ request()->routeIs('admin.akun*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Akun Saya</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="sidebar-item flex items-center px-3 py-2.5 w-full text-gray-700">
                        <i class="fas fa-sign-out-alt w-5"></i><span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Logout</span>
                    </button>
                </form>
            </nav>
            <div class="p-4 border-t border-gray-100" x-show="sidebarOpen">
                <div class="text-xs text-gray-400 text-center">© 2025 PPDB ICB</div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-10 border-b border-gray-100">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
                        <div class="w-9 h-9 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
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