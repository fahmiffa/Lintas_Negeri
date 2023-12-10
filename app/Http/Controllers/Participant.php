<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Alert;
use Auth;

class Participant extends Controller
{
    public function __construct()
    {
        $this->middleware('IsRole:peserta');
    }

    public function class()
    {
        $class = Kelas::all();
        $data = 'Data class';
        return view('class.index',compact('data','class'));    
    }
}
