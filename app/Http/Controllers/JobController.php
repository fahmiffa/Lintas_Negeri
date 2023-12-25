<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Apply;
use App\Models\Head;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use DB;
use App\Rules\Status;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:apply');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $job = Job::all();
        $data = 'Data Pekerjaan';
        return view('job.index',compact('data','job'));   
    }

    public function verif()
    {
        $da = Apply::all();
        $data = 'Data Pekerjaan';
        return view('job.verif',compact('data','da'));    
    }

    public function verfied(Request $request, $id)
    {         
        $apply = Apply::where(DB::raw('md5(id)'),$id)->first();          
        if($apply)
        {
            $user = User::where('id',$apply->users_id)->first();
            $st = $user->stat;
            $var = $st + 1;

            if($st == 8)
            {                           
                $head = Head::where('participant',$apply->users_id)->whereNotIn('status',[0,1])->first();        
    
                $apply->status = 1;
                $apply->save();
                Status::grade($head,'Interview',$var); 
            }

            if($st == 9)
            {                                
                $head = Head::where('participant',$apply->users_id)->whereNotIn('status',[0,1])->first(); 
                $head->job = 1;
                $head->status = 2;
                $head->save();
    
    
                $apply->status = 3;
                $apply->interview = $request->date;
                $apply->save();
                Status::grade($head,'Jadwal Interview',$var); 
            }
            

           Alert::success('success', 'Update Successfully');
        }
        else
        {
            Alert::error('error', 'Invalid Data');
        }


        return back();
    }

    public function reject(Request $request, $id)
    {
        $apply = Apply::where(DB::raw('md5(id)'),$id)->first();          
        if($apply)
        {
            $user = User::where('id',$apply->users_id)->first();
            $st = $user->stat;
            $var = $st + 3;
            $head = Head::where('participant',$apply->users_id)->whereNotIn('status',[0,1])->first(); 
            $head->job = null;
            $head->offline = null;
            $head->save();


            $apply->status = 2;
            $apply->save();

           Status::grade($head,'Reject Job',$var); 
           Alert::success('success', 'Update Successfully');
        }
        else
        {
            Alert::error('error', 'Invalid Data');
        }


        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create job';
        return view('job.create',compact('data'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',   
            'section' => 'required',    
            'addr' => 'required',        
            'salary' => 'required',     
            'kouta' => 'required',     
            'note' => 'required',     
            'open' => 'required',                           
            'close' => 'required',                           
            'interview' => 'required',                           
            ];

            $request->validate($rule);

            $price = str_replace(['.'],null,$request->salary);  

            $job = New Job;
            $job->name = $request->name;
            $job->section = $request->section;
            $job->status = 1;
            $job->interview = $request->interview;
            $job->address = $request->addr;
            $job->kouta = $request->kouta;
            $job->salary = $price;
            $job->open = $request->open;
            $job->close = $request->close;
            $job->note = $request->note;
            $job->save();

            Alert::success('success', 'Insert Successfully');
            return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $data = 'Edit job';
        return view('job.create',compact('data','job'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $rule = [            
            'name' => 'required',   
            'section' => 'required',    
            'addr' => 'required',        
            'salary' => 'required',     
            'kouta' => 'required',     
            'note' => 'required',     
            'open' => 'required',                           
            'close' => 'required',                           
            'interview' => 'required',                           
            ];

            $request->validate($rule);

            $price = str_replace(['.'],null,$request->salary);  

            $job->name = $request->name;
            $job->section = $request->section;
            $job->status = 1;
            $job->interview = $request->interview;
            $job->address = $request->addr;
            $job->kouta = $request->kouta;
            $job->salary = $price;
            $job->open = $request->open;
            $job->close = $request->close;
            $job->note = $request->note;
            $job->save();

            Alert::success('success', 'Update Successfully');
            return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(job $job)
    {
        $job->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
