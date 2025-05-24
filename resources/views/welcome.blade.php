<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapanganKu - Sistem Booking Lapangan</title>
    
    <!-- CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .hero-section {
            background: url('https://images.unsplash.com/photo-1547347298-4074fc3086f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar dengan Tailwind dan Font Awesome -->
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <i class="fas fa-running text-2xl"></i>
                <span class="text-xl font-bold">LapanganKu</span>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="hover:text-indigo-200 transition">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </a>
                <a href="{{ route('register') }}" class="hover:text-indigo-200 transition">
                    <i class="fas fa-user-plus mr-1"></i> Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section flex-grow flex items-center">
        <div class="container mx-auto px-6 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 animate-bounce">
                Booking Lapangan Olahraga Jadi Lebih Mudah
            </h1>
            <p class="text-xl text-white mb-8 max-w-2xl mx-auto">
                Pesan lapangan favoritmu kapan saja, di mana saja dengan sistem booking online kami.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition shadow-lg transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i> Mulai Sekarang
                </a>
                <a href="#features" class="bg-indigo-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow-lg">
                    <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Fitur -->
    <section id="features" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Kenapa Memilih LapanganKu?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Proses Cepat</h3>
                    <p class="text-gray-600">Booking lapangan hanya dalam 3 langkah mudah tanpa ribet.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Jadwal Real-time</h3>
                    <p class="text-gray-600">Lihat ketersediaan lapangan secara real-time.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dukungan 24/7</h3>
                    <p class="text-gray-600">Tim kami siap membantu kapan pun Anda butuhkan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-running text-2xl"></i>
                        <span class="text-xl font-bold">LapanganKu</span>
                    </div>
                    <p class="mt-2 text-gray-400">Solusi booking lapangan olahraga terbaik.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} LapanganKu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- CDN JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</body>
</html>