<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Alert;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsRole:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = Kelas::all();
        $data = 'Data class';
        return view('class.index',compact('data','class'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create class';
        return view('class.create',compact('data'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',
            'price' => 'required',                                 
            ];

        $request->validate($rule);

        $price = str_replace(['.'],null,$request->price);   
        $item = new Kelas;
        $item->name = $request->name;
        $item->price = $price;
        $item->note = $request->note;
        $item->status = 1;
        $item->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('class.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $class = $kelas;
        $data = 'Create class';
        return view('class.create',compact('data','class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas, $id)
    {
        $item = Kelas::findOrFail($id);
        $rule = [            
            'name' => 'required',
            'price' => 'required',                                 
            ];

        $request->validate($rule);

        $price = str_replace(['.'],null,$request->price);        
        $item->name = $request->name;
        $item->price = $price;
        $item->note = $request->note;
        $item->status = 1;
        $item->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('class.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas, $id)
    {        
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
