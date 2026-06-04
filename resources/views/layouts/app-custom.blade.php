<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkindo - System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    <div class="w-64 bg-gradient-to-b from-pink-600 via-purple-950 to-black text-white flex flex-col justify-between shadow-xl">
        <div>
            <div class="p-6 text-center text-2xl font-black tracking-widest border-b border-pink-500/30">
                PARKINDO <span class="text-pink-400">.</span>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <div class="px-4 py-2 text-xs font-semibold uppercase text-pink-300 tracking-wider">Menu Akses: {{ strtoupper(Auth::user()->role) }}</div>
                
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-pink-500/20 border-l-4 border-pink-400 font-medium transition">
                    <span>🏠 Dashboard Utama</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-pink-500/20 bg-black/40">
            <div class="text-sm font-semibold truncate">{{ Auth::user()->name }}</div>
            <div class="text-xs text-pink-300 mb-3">Aktif sebagai {{ Auth::user()->role }}</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white rounded-md font-bold text-sm transition shadow">
                    🚪 Keluar Aplikasi
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white border-b px-8 py-4 flex justify-between items-center shadow-sm">
            <h1 class="text-xl font-bold text-gray-800">Sistem Aplikasi Parkir Terintegrasi</h1>
            <span class="text-sm text-gray-500 font-medium">Jam Sistem: {{ now()->format('d M Y') }}</span>
        </header>

        <main class="p-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>