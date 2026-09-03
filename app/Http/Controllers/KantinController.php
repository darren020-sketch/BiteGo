<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class KantinController extends Controller
{
    /**
     * Menampilkan halaman utama menu kantin
     */
    public function index()
    {
        // Ambil data menu dari database (atau gunakan array jika belum set DB)
        $menus = Menu::all(); 

        return view('kantin.index', compact('menus'));
    }

    /**
     * Menyimpan data menu baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
        ]);

        Menu::create($validated);

        return redirect()->route('kantin.index')->with('success', 'Menu berhasil ditambahkan!');
    }
}