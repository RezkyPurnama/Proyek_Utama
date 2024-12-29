<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna.
     */
    public function profile()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        return view('dashboarduser.profile.index', compact('user'));
    }

    /**
     * Update data profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login

        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id, // Email harus unik kecuali milik user sendiri
            'no_telepon' => 'required',
        ]);

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->no_telepon = $validated['no_telepon'];
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diupdate!');
    }
}
