<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data User',
            'data_user' => User::all(),
        );
        return view('admin.master.user.list',$data);
    }
    public function profile(){
        $user = Auth::user()->id;
        $data = array(
            'title' => 'Data profile',
            'data_profile' => User::where('id', $user)->get(),
        );
        return view('profile',$data);
    }
    public function updateprofile(Request $request, $id){
    
        User::where('id', $id)
        ->where('id', $id)
         ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) ,
            'role' => $request->role,
       ] );
       return redirect('/profile')->with('message', 'Desain Added Successfully');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) ,
            'role' => $request->role,
       ] );
        return redirect('/user')->with('message', 'Desain Added Successfully');
    }
    public function update(Request $request, $id){
    
        User::where('id', $id)
        ->where('id', $id)
         ->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password) ,
            'role' => $request->role,
       ] );
       return redirect('/user')->with('message', 'Desain Added Successfully');
    }
    public function destroy($id){
        $user = User::where('id', $id)->delete();
       return redirect('/user')->with('message', 'Desain Added Successfully');
    }
}

