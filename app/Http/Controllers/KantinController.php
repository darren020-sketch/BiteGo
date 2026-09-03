<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;

class KantinController extends Controller
{
    /**
     * Menampilkan halaman utama (Home Page) BiteGo
     */
    public function index()
    {
        // Data dummy murni untuk kebutuhan tampilan front-end (tanpa DB/Model)
        $menus = collect([
            (object)[
                'nama_menu' => 'Nasi Kuning',
                'deskripsi' => 'Nasi gurih komplit khas kuning komplit disajikan dengan ayam goreng, tempe orak-arik, dan timun segar.',
                'harga' => 12000,
                'foto' => 'https://images.unsplash.com/photo-1626804475297-41608e074eb1?w=400&auto=format&fit=crop'
            ],
            (object)[
                'nama_menu' => 'Ayam Geprek',
                'deskripsi' => 'Ayam renyah dengan sambal pedas membara, disajikan bersama nasi putih hangat dan timun segar.',
                'harga' => 17000,
                'foto' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&auto=format&fit=crop'
            ],
            (object)[
                'nama_menu' => 'Nasi Goreng Telur',
                'deskripsi' => 'Nasi goreng gurih dengan bumbu spesial, disajikan lengkap dengan telur mata sapi dan irisan timun.',
                'harga' => 15000,
                'foto' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400&auto=format&fit=crop'
            ],
            (object)[
                'nama_menu' => 'Mie Goreng Komplit',
                'deskripsi' => 'Mie goreng gurih dengan bumbu racikan, telur mata sapi, sosis, dan timun segar.',
                'harga' => 15000,
                'foto' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&auto=format&fit=crop'
            ],
        ]);

        return view('kantin.index', compact('menus'));
        }
}