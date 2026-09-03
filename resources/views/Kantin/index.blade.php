<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiteGo - Kantin Sekolah</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#F3F8F5] font-sans antialiased text-gray-800">

    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <aside class="w-60 bg-[#004D40] text-white flex flex-col justify-between p-6 shrink-0">
            <div>
                <!-- Brand / Logo -->
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 bg-[#00Bfa5] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-md">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">BiteGo</h1>
                        <p class="text-[10px] text-emerald-200 uppercase tracking-widest font-medium">Smart Canteen</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-3">
                    <a href="{{ route('kantin.index') }}" class="flex items-center gap-4 px-4 py-3 bg-[#00796B] text-white font-medium rounded-xl shadow-sm transition">
                        <i class="fa-solid fa-house text-lg"></i>
                        <span>Home</span>
                    </a>
                    <a href="#" class="flex items-center gap-4 px-4 py-3 text-emerald-100 hover:bg-[#005B4F] rounded-xl transition">
                        <i class="fa-solid fa-utensils text-lg"></i>
                        <span>Menu</span>
                    </a>
                    <a href="#" class="flex items-center gap-4 px-4 py-3 text-emerald-100 hover:bg-[#005B4F] rounded-xl transition">
                        <i class="fa-solid fa-receipt text-lg"></i>
                        <span>Pesanan</span>
                    </a>
                    <a href="#" class="flex items-center gap-4 px-4 py-3 text-emerald-100 hover:bg-[#005B4F] rounded-xl transition">
                        <i class="fa-solid fa-location-dot text-lg"></i>
                        <span>Outlet</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-8 overflow-y-auto">
            <!-- Header (Search & Notification) -->
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-96">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Cari makanan atau minuman..." 
                        class="w-full pl-11 pr-4 py-2.5 bg-white rounded-xl text-xs border border-gray-100 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="relative bg-white p-3 rounded-full shadow-sm border border-gray-100 cursor-pointer hover:bg-gray-50 transition">
                    <i class="fa-regular fa-bell text-gray-700 text-base"></i>
                    <span class="absolute top-0 right-0 w-4 h-4 bg-emerald-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center border-2 border-white">3</span>
                </div>
            </div>

            <!-- Hero Banner Section -->
            <div class="flex items-center justify-between bg-[#E8F5E9] rounded-3xl p-8 mb-8 relative overflow-hidden">
                <div class="max-w-lg z-10">
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-3">
                        Pesan Sesukamu, <br>
                        <span class="text-[#00B894]">Ambil Sendiri.</span>
                    </h2>
                    <p class="text-gray-500 text-xs mb-6 leading-relaxed">
                        Pilih makanan, pesan, dan ambil<br>
                        di outlet pilihanmu.<br>
                        Tanpa antre tanpa tunggu lama.
                    </p>
                    <a href="#menu-terlaris" class="inline-flex items-center gap-2 bg-[#00BFA5] hover:bg-[#00A892] text-white px-6 py-3 rounded-full font-bold text-xs uppercase tracking-wider shadow-lg shadow-emerald-500/20 transition">
                        Lihat Menu <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <!-- Banner Image -->
                <div class="w-80 h-80 rounded-full overflow-hidden shrink-0 border-4 border-white shadow-xl z-10">
                    <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600&auto=format&fit=crop" alt="Hero Dish" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Category Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800">Kategori</h3>
                    <a href="#" class="text-xs font-semibold text-emerald-600 hover:underline flex items-center gap-1">
                        Lihat Semua <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <!-- Kategori 1: Makanan Utama -->
                    <div class="bg-white p-3.5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer hover:border-emerald-300 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-gray-900 text-white flex items-center justify-center text-sm">
                                <i class="fa-solid fa-[#00BFA5]"></i>
                                <span class="text-xs">🍱</span>
                            </div>
                            <span class="text-xs font-bold text-gray-800">Makanan Utama</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                    </div>

                    <!-- Kategori 2: Snack -->
                    <div class="bg-white p-3.5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer hover:border-emerald-300 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-sm">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-800">Snack</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                    </div>

                    <!-- Kategori 3: Minuman -->
                    <div class="bg-white p-3.5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer hover:border-emerald-300 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-amber-400 text-white flex items-center justify-center text-sm">
                                <i class="fa-solid fa-glass-water"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-800">Minuman</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                    </div>

                    <!-- Kategori 4: Dessert -->
                    <div class="bg-white p-3.5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer hover:border-emerald-300 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-rose-400 text-white flex items-center justify-center text-sm">
                                <i class="fa-solid fa-ice-cream"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-800">Dessert</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Menu Terlaris Section -->
            <div id="menu-terlaris">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800">Menu Terlaris</h3>
                    <a href="#" class="text-xs font-semibold text-emerald-600 hover:underline flex items-center gap-1">
                        Lihat Semua <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Menu Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($menus as $menu)
                        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div class="w-full h-36 rounded-2xl overflow-hidden mb-3 bg-gray-100">
                                    <img src="{{ $menu->foto }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                                </div>
                                <h4 class="font-bold text-sm text-gray-900 mb-1">{{ $menu->nama_menu }}</h4>
                                <p class="text-[11px] text-gray-400 leading-relaxed line-clamp-2 mb-4">
                                    {{ $menu->deskripsi }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                                <span class="font-bold text-emerald-600 text-sm">
                                    Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                </span>
                                <button class="px-4 py-1.5 border border-emerald-400 text-emerald-600 text-xs font-semibold rounded-full hover:bg-emerald-600 hover:text-white transition">
                                    Pesan
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

</body>
</html>