<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroPlant - {{ $title ?? 'E-Commerce Hidroponik' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <livewire:styles />

    <style>
        .header-font { font-family: 'Poppins', sans-serif; }
        .body-font { font-family: 'Lato', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 body-font">

    <!-- Header -->
    <header class="bg-[#375534] text-white header-font">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl font-bold">🌱 HydroPlant</span>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ url('/') }}" class="hover:text-[#AEC380] transition">Beranda</a>
                    <a href="{{ url('/products') }}" class="hover:text-[#AEC380] transition">Produk</a>
                    <a href="{{ url('/featured') }}" class="hover:text-[#AEC380] transition">Best Seller</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#375534] text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="header-font text-lg">HydroPlant</p>
            <p class="body-font mt-2">Menumbuhkan Alam, Mendekatkan Kehidupan</p>
            <p class="body-font mt-4 text-sm text-gray-300">
                &copy; 2024 HydroPlant. All rights reserved.
            </p>
        </div>
    </footer>

    <livewire:scripts />
</body>
</html>
