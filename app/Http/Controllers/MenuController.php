<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Menampilkan halaman daftar menu berdasarkan kategori
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'makanan-utama');

        $allMenus = collect([
            (object)[
                'nama_menu' => 'Nasi Kuning',
                'deskripsi' => 'Nasi kuning gurih disajikan dengan ayam goreng, tempe orak-arik, dan timun.',
                'harga' => 11000,
                'foto' => 'https://images.unsplash.com/photo-1626804475297-41608e074eb1?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Rice Bowl Dori Crispy',
                'deskripsi' => 'Ikan dori goreng renyah yang disajikan di atas nasi hangat dengan saus mayo/keju dan mayo teriyaki.',
                'harga' => 17000,
                'foto' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Mie Goreng Telur',
                'deskripsi' => 'Mie goreng lezat disajikan dengan telur ceplok matang dan lalapan segar.',
                'harga' => 13000,
                'foto' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Nasi Goreng Telur Ceplok',
                'deskripsi' => 'Nasi goreng dengan bumbu spesial disajikan hangat dengan telur ceplok.',
                'harga' => 15000,
                'foto' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Nasi Liwet Ayam Goreng',
                'deskripsi' => 'Nasi liwet gurih beraroma rempah, disajikan dengan ayam goreng, tahu, tempe, lalapan, dan sambal terasi.',
                'harga' => 22000,
                'foto' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Sate Ayam',
                'deskripsi' => 'Sate ayam empuk yang dibakar dengan bumbu kacang gurih manis, disajikan dengan irisan bawang merah dan lontong.',
                'harga' => 16000,
                'foto' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Ayam Geprek Sambal Ijo',
                'deskripsi' => 'Ayam goreng tepung renyah dengan ulekan sambal hijau, disajikan hangat dengan nasi putih dan timun.',
                'harga' => 17000,
                'foto' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Nasi Chicken Katsu',
                'deskripsi' => 'Daging ayam fillet renyah dilapisi tepung panir dan saus gurih khas Jepang di atas nasi hangat.',
                'harga' => 15000,
                'foto' => 'https://images.unsplash.com/photo-1562967914-608f82629710?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Paket Ayam Geprek',
                'deskripsi' => 'Nasi hangat dengan fillet ayam goreng renyah dengan bumbu pedas gurih lengkap dengan lalapan.',
                'harga' => 14000,
                'foto' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Paket Ayam Sambal Matah',
                'deskripsi' => 'Ayam goreng renyah disiram dengan sambal matah khas Bali segar, nikmat disajikan hangat dengan nasi putih.',
                'harga' => 18000,
                'foto' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Sate Taichan Nasi Jeruk',
                'deskripsi' => 'Sate ayam taichan bakar polos dengan bumbu pedas, disajikan bersama nasi beraroma daun jeruk gurih dan sambal pedas.',
                'harga' => 21000,
                'foto' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Mie Ayam Bakso',
                'deskripsi' => 'Mie ayam lezat yang disajikan lengkap dengan bakso, taburan ayam bumbu, daun sawi hijau, dan kuah gurih.',
                'harga' => 14000,
                'foto' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Nasi Telur Kecap',
                'deskripsi' => 'Nasi hangat disajikan dengan telur dadar/ceplok gurih berminyak kecap manis gurih.',
                'harga' => 12000,
                'foto' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Nasi Chicken Teriyaki',
                'deskripsi' => 'Potongan daging ayam manis gurih disajikan di atas nasi hangat dengan taburan wijen dan irisan wortel.',
                'harga' => 16000,
                'foto' => 'https://images.unsplash.com/photo-1562967914-608f82629710?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Nasi Bakar Ayam Suwir',
                'deskripsi' => 'Nasi bakar wangi dengan isian ayam suwir pedas gurih kemangi, disajikan hangat lengkap dengan lalapan segar.',
                'harga' => 15000,
                'foto' => 'https://images.unsplash.com/photo-1626804475297-41608e074eb1?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
            (object)[
                'nama_menu' => 'Bakso Urat',
                'deskripsi' => 'Semangkuk bakso urat lezat dan gurih disajikan dengan mie, tahu, sayur sawi, kuah kaldu hangat, dan taburan seledri.',
                'harga' => 16000,
                'foto' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&auto=format&fit=crop',
                'kategori' => 'makanan-utama'
            ],
        ]);

        $menus = $allMenus->where('kategori', $category);

        return view('canteen.menu', [
            'menus' => $menus,
            'activeCategory' => $category
        ]);
    }
}