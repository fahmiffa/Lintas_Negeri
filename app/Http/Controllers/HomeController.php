<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->participant())
        {
            return view('participant');     
        }
        else
        {
            return view('main');     
        }
    }    

    public function profile()
    {
        $user = User::where('id',Auth::user()->id)->first();

        $data = 'Profile';
        return view('profile',compact('data','user'));  
    }    

    public function account(Request $request)
    {       
        $user = User::where('id',Auth::user()->id)->first();
        $rule = [            
            'name' => 'required',
            'email' => 'required',
            'hp' => 'required',                                                        
            ];

        $request->validate($rule);

        $item = $user;
        $item->name = $request->name;
        $item->email = $request->email;
        $item->hp = $request->hp;
        if($request->password)
        {
            $item->password = bcrypt($request->password);
        }
        // $item->status = 1;
        $item->save();
        
        Alert::success('success', 'Update Successfully');
        return back();
    }
}
