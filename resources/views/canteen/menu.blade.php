<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiteGo - Page Menu</title>
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
                    <div class="w-10 h-10 bg-[#00BFA5] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-md">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">BiteGo</h1>
                        <p class="text-[10px] text-emerald-200 uppercase tracking-widest font-medium">Smart Canteen</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-3">
                    <a href="{{ route('canteen.index') }}" class="flex items-center gap-4 px-4 py-3 text-emerald-100 hover:bg-[#005B4F] rounded-xl transition">
                        <i class="fa-solid fa-house text-lg"></i>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('canteen.menu') }}" class="flex items-center gap-4 px-4 py-3 bg-[#00796B] text-white font-medium rounded-xl shadow-sm transition">
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
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" placeholder="Cari makanan atau minuman..." 
                        class="w-full pl-10 pr-4 py-2 bg-white rounded-lg text-xs border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <!-- Page Title -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Menu</h2>
                <p class="text-xs text-gray-500 mt-0.5">Pilih Kategori</p>
            </div>

            <!-- Category Tabs -->
            <div class="border-b border-gray-200 mb-8">
                <div class="flex gap-8 text-xs font-semibold">
                    <a href="{{ route('canteen.menu', ['category' => 'makanan-utama']) }}" 
                       class="pb-3 border-b-2 transition {{ $activeCategory === 'makanan-utama' ? 'border-[#00BFA5] text-[#00BFA5]' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                        Makanan Utama
                    </a>
                    <a href="{{ route('canteen.menu', ['category' => 'snack']) }}" 
                       class="pb-3 border-b-2 transition {{ $activeCategory === 'snack' ? 'border-[#00BFA5] text-[#00BFA5]' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                        Snack
                    </a>
                    <a href="{{ route('canteen.menu', ['category' => 'minuman']) }}" 
                       class="pb-3 border-b-2 transition {{ $activeCategory === 'minuman' ? 'border-[#00BFA5] text-[#00BFA5]' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                        Minuman
                    </a>
                    <a href="{{ route('canteen.menu', ['category' => 'dessert']) }}" 
                       class="pb-3 border-b-2 transition {{ $activeCategory === 'dessert' ? 'border-[#00BFA5] text-[#00BFA5]' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                        Dessert
                    </a>
                </div>
            </div>

            <!-- Menu Grid (4 Columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($menus as $menu)
                    <div class="bg-white rounded-2xl p-3.5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            <div class="w-full h-32 rounded-xl overflow-hidden mb-3 bg-gray-100">
                                <img src="{{ $menu->foto }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-bold text-xs text-gray-900 mb-1 line-clamp-1">{{ $menu->nama_menu }}</h4>
                            <p class="text-[10px] text-gray-400 leading-snug line-clamp-2 mb-4">
                                {{ $menu->deskripsi }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                            <span class="font-bold text-gray-900 text-xs">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </span>
                            <button class="px-3 py-1 bg-[#00BFA5] hover:bg-[#00A892] text-white text-[11px] font-semibold rounded-lg flex items-center gap-1 transition">
                                <i class="fa-solid fa-plus text-[9px]"></i> Pesan
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

</body>
</html>