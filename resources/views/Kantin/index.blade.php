<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Sekolah - Daftar Menu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f9; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .alert { padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Menu Kantin Sekolah</h1>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $index => $menu)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td>{{ $menu->stok }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada menu yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>