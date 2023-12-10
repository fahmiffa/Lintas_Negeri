<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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

    public function sign(Request $request)
    {
        $rule = [            
                'email' => 'required',
                'password' => 'required',     
            ];

        $request->validate($rule);

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
