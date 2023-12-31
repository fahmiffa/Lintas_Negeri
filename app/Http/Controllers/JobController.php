<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Apply;
use App\Models\Head;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Data;
use Alert;
use DB;
use App\Rules\Status;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:job');
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
        $da = Apply::withTrashed()->get();
        $data = 'Data CV';
        return view('job.verif',compact('data','da'));    
    }

    public function interview()
    {
        $da = Apply::withTrashed()->get();
        $data = 'Data interview';
        return view('job.interview',compact('data','da'));    
    }

    public function doc($id)
    {           
        $apply = Apply::where(DB::raw('md5(id)'),$id)->first();    
        if($apply)
        {
            $name = 'CV'.$apply->users_id.''.$apply->head.''.date('Ymd').'.doc';
            $doc = true;
            $path = public_path('/assets/compiled/jpg/1.jpg');
            $image = "data:image/png;base64,".base64_encode(file_get_contents($path));
            $data = data::where('users_id',$apply->users_id)->first();
            return view('participant.doc',compact('data','apply','name','doc','image','path'));       
        }
        else
        {
            Alert::error('error', 'Invalid Data');
            return back();
        }
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
                Status::log('Interview '.$user->name. ' di '.$apply->job->name); 
            }

            if($st == 9)
            {                                
                $head = Head::where('participant',$apply->users_id)->whereNotIn('status',[0,1])->first(); 
                $head->job = 1;
                $head->status = 2;
                $head->save();
    
          
                $apply->interview = $request->date;
                $apply->save();
                Status::grade($head,'Jadwal Interview',$var); 
                Status::log('Meyetujui jadwal Interview '.$user->name. ' di '.$apply->job->name); 
            }

            if($st == 10)
            {                                
                $head = Head::where('participant',$apply->users_id)->whereNotIn('status',[0,1])->first(); 
                $head->job = 1;
                $head->status = 2;
                $head->save();
    
          
                $apply->status = 3;
                $apply->save();
                Status::grade($head,'Verfikasi interview diterima',$var); 
                Status::log('Menerima verfikasi interview'.$user->name.' di '.$apply->job->name); 
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
            $var = $st + 1;
            $head = Head::where('participant',$apply->users_id)->whereNotIn('status',[0,1])->first(); 
            $head->job = null;   
            $head->save();

            $apply->status = 2;
            $apply->note   = $request->ket;
            $apply->save();

            
            // Status::grade($head,'Verfikasi interview ditolak',$var); 
            Status::grade($head,'Offline Class',7); 
            Status::log('Menolak verfikasi interview '.$user->name.' di '.$apply->job->name); 
            
            $apply->delete();
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
