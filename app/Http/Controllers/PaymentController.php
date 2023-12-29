<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;
use Alert;

class PaymentController extends Controller
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
        $da = Payment::all();  
        $data = 'Data Payment';
        return view('payment.index',compact('data','da'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create Payment';
        return view('payment.create',compact('data')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',   
            'numbers' => 'required',    
            'type' => 'required',        
            ];
        $message = ['required'=>'field ini harus disi'];

        $request->validate($rule,$message);

        $pay = new Payment;
        $pay->name = $request->name;
        $pay->numbers = $request->numbers;
        $pay->type = $request->type;        
        $pay->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payment $payment)
    {
        $data = 'Edit Payment';
        return view('payment.create',compact('data','payment')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, payment $payment)
    {
        $rule = [            
            'name' => 'required',   
            'numbers' => 'required',    
            'type' => 'required',        
            ];

        $request->validate($rule);

        $pay = $payment;
        $pay->name = $request->name;
        $pay->numbers = $request->numbers;
        $pay->type = $request->type;        
        $pay->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payment $payment)
    {
        $payment->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
