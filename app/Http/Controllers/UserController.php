<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email', // Validasi email harus unik
            'password' => 'required|confirmed',
            'no_telepon' => 'required',
        ]);

        $validated['remember_token'] = Str::random(10);
        $validated['email_verified_at'] = now();
        $validated['password'] = Hash::make($validated['password']); // Hash password

        User::create($validated);
        return redirect('mengelola-user')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id, // Validasi email harus unik kecuali dirinya sendiri
            'no_telepon' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->no_telepon = $validated['no_telepon'];

        if ($request->filled('password')) { // Periksa jika password diisi
            $validated['password'] = Hash::make($request->password);
            $user->password = $validated['password'];
        }

        $user->save();
        return redirect('mengelola-user')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('mengelola-user');
    }
}
