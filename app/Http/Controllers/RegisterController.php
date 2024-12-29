<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str; // Ubah ini
use Illuminate\Http\Request;
use App\Models\User; // Pastikan ini juga ada
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function proses_register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|',
            'no_telepon' => 'required|numeric|digits_between:10,15',
             Password::min(8)->letters(),
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['email_verified_at'] = now();
        $validatedData['remember_token'] = Str::random(10);
        User::create($validatedData);
        return redirect('/login');
    }
}
