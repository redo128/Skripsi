<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index(){
        return view('register');
    }
    function store(Request $request){
        $request->validate([
            'email'=>'required|unique:users',
            'password'=>'required'
        ],[
            'email.required'=>'email wajib diisi',
            'email.unique'=> ' email telah digunakan',
            'password.required'=>'password wajib diisi'
        ]);
        $data=new User;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=Hash::make($request->password);
        $data->role="pembeli";
        $data->toko_id=1;
        $data->save();
        return redirect()->route('login');

    }
}
