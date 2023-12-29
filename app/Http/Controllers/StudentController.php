<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Alert;
use Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:lpk');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Student::where('lpk',Auth::user()->id)->get();

        $data = 'Data Siswa';
        return view('lpk.student.index',compact('data','da')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create Siswa';
        $user = User::where('role','peserta')->get();
        return view('lpk.student.create',compact('data','user'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'account' => 'required'                     
            ];

        $message = ['required'=>'Field ini harus disi'];
        $request->validate($rule,$message);       
               
        $item           = new Student;
        $item->lpk      = Auth::user()->id;
        $item->student  = $request->account;
        $item->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $data = 'Edit Siswa';
        $user = User::where('role','peserta')->get();
        return view('lpk.student.create',compact('data','user','student'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $rule = [            
            'account' => 'required',                             
            ];

        $message = ['required'=>'Field ini harus disi'];
        $request->validate($rule,$message);       

       
        $item           = $student;
        $item->lpk      = Auth::user()->id;
        $item->student = $request->account;
        $item->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
