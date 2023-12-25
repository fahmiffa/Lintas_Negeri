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
        $da = Paid::all();
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
    public function store(Request $request)
    {
        //
    }

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
            Alert::success('success', 'Verif Successfully');
        }
        else
        {
            Alert::error('info', 'invalid Request');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Head $head)
    {
        //
    }
}
