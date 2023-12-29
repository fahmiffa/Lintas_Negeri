<?php

namespace App\Http\Controllers;

use App\Models\Head;
use App\Models\Paid;
use Illuminate\Http\Request;
use Auth;
use Alert;
use DB;
use App\Models\Participant;
use App\Models\User;
use App\Rules\Status;

class HeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:payment');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = 'Payment List';
        $da = Paid::withTrashed()->get();
        return view('paid.index',compact('da','data'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(Head $head)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Head $head)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Head $head, $id)
    {
        
        $paid = Paid::where(DB::raw('md5(id)'),$id)->first();
        $head = Head::where('id',$paid->head)->first();
        if($head && $paid)
        {            
            $st = $head->user->stat;           
            if($st == 1)
            {
                $head->online = 1;
            }            

            if($st == 4)
            {
                $head->offline = 1;
            }            
            $head->save();

            $paid->status = 1;
            $paid->employee = Auth::user()->id;
            $paid->save();
            
            $var = 1 + $st;
            Status::grade($head,'verified payment '.$paid->kelas->name,$var);   
            Status::log('verified payment '.$paid->kelas->name);                             
            Alert::success('success', 'Verif Successfully');
        }
        else
        {
            Alert::error('info', 'invalid Request');
        }

        return back();
    }

    public function reject(Request $request, $id)
    { 
        if($request->ket == null)
        {
            Alert::error('info', 'Keterangan wajib disi, jika di tolak');
            return back()->withInput();
        }
        
        $paid = Paid::where(DB::raw('md5(id)'),$id)->first();
        $head = Head::where('id',$paid->head)->first();
        if($head && $paid)
        {                 
            $st = $head->user->stat;    

            $paid->status   = 2;
            $paid->ket       = $request->ket;
            $paid->employee = Auth::user()->id;
            $paid->save();
            
            $par = Participant::where('head',$head->id)->first();
            $par->delete();
            $head->delete();
            $paid->delete();
            Alert::success('success', 'Verif Successfully');
        }
        else
        {
            Alert::error('info', 'invalid Request');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Head $head)
    {
        //
    }
}
