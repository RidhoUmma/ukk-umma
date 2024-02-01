<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

class AuthController extends Controller
{
    //
     // Menampilkan form login
     public function showLoginForm()
     {
         return view('auth.login');
     }
 
     // Proses login
     public function login(Request $request)
     {
         $credentials = $request->only('email', 'password');
     
         if (Auth::attempt($credentials)) {
             $role = Auth::user()->role;
     
             if ($role === 'admin') {
                 return redirect()->route('admin.admin');
             } else {
                 return redirect()->route('kasir.kasir');
             }
         }
     
         // Jika autentikasi gagal, cek jenis kesalahan dan redirect dengan pesan yang sesuai
         $user = User::where('email', $credentials['email'])->first();
     
         if ($user) {
             // Kesalahan pada password
             return redirect()->route('login')->withErrors(['password' => 'Salah Password.']);
         } elseif ($user && !Hash::check($credentials['password'], $user->password)) {
             // Kesalahan pada email
             return redirect()->route('login')->withErrors(['email' => 'Salah Email.']);
         } else {
             // Kesalahan keduanya
             return redirect()->route('login')->withErrors(['both' => 'Salah email and password.']);
         }
     }
     
 
    public function logout()
    {
        Auth::logout();

        // Membersihkan data sesi
        session()->flush();

        // Diarahkan ke halaman login
        return redirect()->route('login');
    }
 
}
