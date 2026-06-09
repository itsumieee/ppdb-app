<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB SMK ICB Cinta Teknika')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('student.beranda') }}" class="text-xl font-bold text-blue-600">SMK ICB Cinta Teknika</a>
                    </div>
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="{{ route('student.beranda') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
                        <a href="{{ route('student.jadwal') }}" class="text-gray-700 hover:text-blue-600">Jadwal</a>
                        <a href="{{ route('student.pengumuman') }}" class="text-gray-700 hover:text-blue-600">Pengumuman</a>
                        @auth
                            @if(Auth::user()->registration)
                                <a href="{{ route('student.status') }}" class="text-gray-700 hover:text-blue-600">Status</a>
                                <a href="{{ route('student.bukti') }}" class="text-gray-700 hover:text-blue-600">Bukti</a>
                            @endif
                            <a href="{{ route('student.profile') }}" class="text-gray-700 hover:text-blue-600">Profil</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-blue-600">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-12 py-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} PPDB SMK ICB Cinta Teknika. All Rights Reserved.
        </footer>
    </div>
</body>
</html>