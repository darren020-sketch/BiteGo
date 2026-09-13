<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['nullable', 'string', 'max:20'],
            'kelas' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'siswa',
            'nis' => $data['nis'] ?? null,
            'kelas' => $data['kelas'] ?? null,
        ]);

        Auth::login(User::where('email', $data['email'])->first());

        return redirect()->route('canteen.index')
            ->with('success', 'Akun berhasil dibuat. Selamat datang di BiteGo!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();

        $fallback = Auth::user()->isVendor()
            ? route('vendor.dashboard')
            : route('canteen.index');

        if ($request->filled('redirect') && str_starts_with($request->input('redirect'), '/')) {
            return redirect($request->input('redirect'));
        }

        return redirect()->intended($fallback);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('canteen.index');
    }
}
