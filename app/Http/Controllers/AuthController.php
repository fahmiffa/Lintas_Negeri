<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Models\User;
use App\Mail\MyMail;
use Mail;
use DB;
use Carbon\Carbon;


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

    public function ver($id)
    { 
        $usr = User::where(DB::raw('md5(ver)'),$id)->where('status',2)->first();
        if($usr)
        {
            $usr->status = 1;
            $usr->save();

            return redirect()->route('login')->with('info','Verifikasi akun berhasil');
        }        
        else
        {
            return redirect()->route('login')->with('error','Invalid link Verifikasi');
        }
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
        $item->status = 2;   
        $item->save();

        $ver = Carbon::parse($item->created_at)->timestamp;
        $item->ver = $ver;
        $item->save();


        $link = route('ver',['id'=>md5($ver)]);
        
        $details = [     
            'title' => 'Verifikasi akun',
            'body'  => 'Klik link berikut untuk aktivasi akun peserta' ,
            'par'   => $link  
        ];
        
        Mail::to($request->email)->send(new MyMail($details));

        Alert::success('success', 'Register Successfully, check email to verify');
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
    
            if($user->status == 1)
            {
                return redirect()->route('home');             
            }
            else
            {
                $request->session()->flush();
                Auth::logout();
                return back()->withInput()->with('error', 'Account not verified');
            }    
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
