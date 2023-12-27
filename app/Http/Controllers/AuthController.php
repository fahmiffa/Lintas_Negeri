<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {                
        $data = 'Login';            
        return view('login');
    } 

    public function reg()
    {                
        $data = 'Daftar';            
        return view('reg');
    } 

    public function daftar(Request $request)
    {
        $rule = [            
                'email' => 'required|unique:users,email',
                'hp' => 'required',
                'user' => 'required',
                'password' => 'required',     
            ];
        $message = ['required'=>'Field ini harus disi', 'unique'=> 'email sudah terdaftar'];

        $request->validate($rule,$message);

        $item = new User;
        $item->name = $request->user;
        $item->email = $request->email;
        $item->hp = $request->hp;
        $item->role = 'peserta';
        $item->password = bcrypt($request->password);
        $item->status =1;
        $item->save();

        Alert::success('success', 'Register Successfully');
        return redirect()->route('login');
    }

    public function sign(Request $request)
    {
        $rule = [            
                'email' => 'required',
                'password' => 'required',     
            ];

        $message = ['required'=>'Field ini harus disi'];

        $request->validate($rule,$message);

        $credensil = $request->only('email','password');;

        if (Auth::attempt($credensil)) {
            $user = Auth::user();                      
            return redirect()->route('home');             
        }                          
        return back()->withInput()->with('error', 'Account not found');
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
    }
}
