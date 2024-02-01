<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index(){
    //     $data = array(
    //         'title' => 'Home Page'
    //     );
    //     return view('home',$data);
    // }
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return view('admin.admin');
        } elseif ($role === 'kasir') {
            return view('kasir.kasir');
        }

        // Jika peran tidak sesuai, Anda dapat menangani sesuai kebutuhan, contohnya:
        abort(403, 'Unauthorized action.'); // Tampilkan halaman error 403 (Forbidden)
    }
}
