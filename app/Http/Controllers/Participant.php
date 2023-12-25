<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Head;
use App\Models\Exam;
use App\Models\Test;
use Alert;
use Auth;
use DB;
use App\Models\Participant as Par;
use App\Models\Question;
use App\Models\User;
use App\Rules\Status;
use App\Models\Data;
use App\Models\Job;
use App\Models\Paid;
use App\Models\CV;
use App\Models\Apply;
use App\Models\Payment;
use PDF;


class Participant extends Controller
{
    public function __construct()
    {
        $this->middleware('IsRole:peserta');
    }

    public function class()
    {
        $head = Head::where('participant',Auth::user()->id)->where('status','!=',1)->first();
        if($head)
        {
            return redirect()->route('daftar.index',['id'=>md5($head->id)]);
        }
        else
        {
            $kelas = Kelas::where('name','Online Class')->first();    
            $class = Kelas::all();
            $da = Payment::all();
            $exam = Exam::first();    
            $data = 'Pendaftaran Kelas';
            return view('participant.index',compact('data','class','kelas','da','head'));    
        }
    }

    public function daftar($id)
    {
        $users = Auth::user()->id;
        $head = Head::where('participant',$users)->whereNotIn('status',[0,1])->first();   
        $kelas = Kelas::where('name','Offline Class')->first();
        $apply = Apply::where('users_id',$users)->first();   
        $da = Payment::all();
        $exam = Exam::first();    
        $job = Job::all();
        $st = (int) Auth::user()->stat; 

        $test = Test::where('users_id',$users)->where('status',0)->first();
        if($test)
        {        
            $data = 'Test '.$test->exam->kelas->name;
            return view('user.exam.test',compact('test','data'));  
        }  
        else
        {
            $data = 'Pendaftaran';
            return view('participant.index',compact('data','head','kelas','da','exam','job','apply'));    
        }

    }

    public function store(Request $request, $id)
    {
        $users = Auth::user()->id;
        $head = Head::where('participant',$users)->whereNotIn('status',[0,1])->first();   
        $class = Kelas::where(DB::raw('md5(id)'),$id)->first(); 
        $job = Job::where(DB::raw('md5(id)'),$id)->first();   
        $st = (int) Auth::user()->stat; 
        $var = $st + 1;     
        
        // online class      
        if($class && $st == 0)
        {            
            $rule = [            
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',                       
                ];
            $message = [
                        'required'=> 'File Transfer required',
                        'mimes'=> 'Extension File invalid',
                        'max'=> 'File size max 2Mb'
                        ];
    
            $request->validate($rule,$message);

            $pile = $request->file('file');               
            $piles = 'tf_'.time().'.'.$pile->getClientOriginalExtension();
            $destinationPath = public_path('assets/image');
            $pile->move($destinationPath, $piles);            

            $head = new Head;      
            $head->participant = Auth::user()->id;    
            $head->status = 4;    
            $head->save();

            $paid        = new Paid;
            $paid->head  = $head->id;
            $paid->user  = $head->participant;
            $paid->par   = $class->id;
            $paid->img   = $piles;
            $paid->save();

            Status::grade($head,$class->name,$var);     

            return redirect()->route('daftar.index',['id'=>md5($head->id)]);

        }

        // identitas
        else if($st == 2)
        {
   
            $rule = [            
                'alamat'       => 'required',      
                'place_birth' => 'required',      
                'date_birth' => 'required',     
                'date_birth' => 'required',     
                'date_birth' => 'required',     
                'date_birth' => 'required',                       
                ];
                $message = ['required'=>'field ini harus disi'];
    
            $request->validate($rule,$message);

            $data = new Data;
            $data->users_id = $head->participant;
            $data->alamat = $request->alamat;
            $data->gender = $request->gender;
            $data->place_birth = $request->place_birth;
            $data->date_birth= $request->date_birth;
            $data->married = $request->married;
            $data->religion = $request->religion;
            $data->tall = $request->tall;
            $data->weight = $request->weight;
            $data->blood = $request->blood;
            $data->hobbies = $request->hobbies;
            $data->dad = json_encode([$request->dad,$request->ageDad]);
            $data->mom = json_encode([$request->mom,$request->ageMom]);
            $data->sis = json_encode([$request->sis,$request->ageSis]);
            $data->bro = json_encode([$request->bro,$request->ageBro]);
 
            if(count($request->job) > 0)
            {
               $job = $request->job;              
               $period = $request->jobPeriod;
               $va = $request->var;
 
               for ($i=0; $i < count($job); $i++) {       
                 if($job[$i] != null)
                 {
                     $jobs[] = [$job[$i],$period[$i],$va[$i]];
                 }          
               }
 
               $data->job = json_encode($jobs);           
            }
 
            if(count($request->studied) > 0)
            {
               $study = $request->studied;
               $perioded = $request->perioded;     
 
               for ($i=0; $i < count($study); $i++) {        
                 if($study[$i] != null)
                 {
                     $studied[] = [$study[$i],$perioded[$i]];
                 }         
               }
 
               $data->study = json_encode($studied);           
            }   
            $data->save();
            
            Status::grade($head,'Inserted Indentity',$var); 

            return back();

        }  
        // exam start
        else if($st == 3)
        {      
            $test = new Test;
            $test->users_id = Auth::user()->id;
            $test->exams_id = $exam->id;
            $test->start    = date('Y-m-d H:i:s');
            $test->save();
 
            Status::grade($head,'Exam start',$var);
            return redirect()->route('testing',['id'=>md5($test->id)]);
        }
        else if($st == 4)
        {
            $test = Test::where(DB::raw('md5(id)'),$id)->first();       

            $point = 0;
            $q = $request->input('q');
            foreach($q as $key => $item)
            {
                $cc = Question::where('id',$key)->where('key',$item)->exists();
                if($cc)
                {
                    $point +=1;
                }                
            }
            
            $test->val = $point;
            $test->head = $head->id;
            $test->log = json_encode($q);
            $test->end = date('Y-m-d H:i:s');
            $test->status = 1;
            $test->save();

            Status::grade($head,'Exam Tested',$var);  

            return redirect()->route('daftar.index',['id'=>md5($head->id)]);
        }
        // offline class
        else if($class && $st == 5)
        {
            $rule = [            
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',                       
                ];
            $message = [
                        'required'=> 'File Transfer required',
                        'mimes'=> 'Extension File invalid',
                        'max'=> 'File size max 2Mb'
                        ];
    
            $request->validate($rule,$message);
        
            $st = Auth::user()->stat;
            $pile = $request->file('file');               
            $piles = 'tf_'.time().'.'.$pile->getClientOriginalExtension();
            $destinationPath = public_path('assets/image');
            $pile->move($destinationPath, $piles);  
                
            $head->status = 3;    
            $head->save();

            $paid        = new Paid;
            $paid->head  = $head->id;
            $paid->user  = $head->participant;
            $paid->par   = $class->id;
            $paid->img   = $piles;
            $paid->save();

            Status::grade($head,$class->name,$var); 
            
            return back();
        }
        // apply job
        else if($st == 7 && $job)
        {                           
            $rule = [            
                'vid'       => 'required',                              
                ];
            $message = ['required'=>'field ini harus disi'];
    
            $request->validate($rule,$message);

            $apply = New Apply;
            $apply->head = $head->id;
            $apply->jobs_id = $job->id;
            $apply->users_id = $users;
            $apply->video = $request->vid;
            $apply->save();

            Status::grade($head,'Apply Job',$var);  
            return redirect()->route('daftar.index',['id'=>md5($head->id)]);
        }
        else
        {
            Alert::error('info', 'invalid Data');
            return back();
        }

    }

    private function step($request, $id)
    {
        $class = Kelas::where(DB::raw('md5(id)'),$id)->first();
        if($class)
        {
            $st = Auth::user()->stat;
            $pile = $request->file('file');               
            $piles = 'tf_'.time().'.'.$pile->getClientOriginalExtension();
            $destinationPath = public_path('assets/image');
            $pile->move($destinationPath, $piles);            

            $head = new Head;      
            $head->participant = Auth::user()->id;    
            $head->status = 4;    
            $head->save();

            $paid        = new Paid;
            $paid->head  = $head->id;
            $paid->user  = $head->participant;
            $paid->par   = $class->id;
            $paid->img   = $piles;
            $paid->save();

            $var = $st + 1;
            Status::grade($head,$class->name,$var);     


            Alert::success('success', 'Upload Successfully');
            return redirect()->route('daftar.index',['id'=>md5($head->id)]);
        }
        else
        {
            Alert::error('info', 'invalid Request');
        }        
     
    }

    public function apply($id,$head)
    {
        $cv = Cv::where('users_id',Auth::user()->id)->first();
        $head = Head::where(DB::raw('md5(id)'),$head)->first();
        $job = Job::where(DB::raw('md5(id)'),$id)->first();
        $data = 'Pendaftaran di '.$job->name;
        return view('participant.apply',compact('data','head','job','cv'));  
    }

    public function cv(Request $request)
    {
        $user = Auth::user()->id;
        $data = Data::where('users_id',$user)->latest()->first();
        $path = 'assets/cv/cv-'.$user.'.pdf';
        $cv = new CV;
        $cv->users_id = $user;
        $cv->file = $path;

        $cv->save();
        $da = compact('data');
        $pdf = Pdf::loadView('participant.cv',$da);               
        $pdf->save(public_path($path));      
        // return $pdf->stream();
        // return view('participant.cv',$da);
        return back();
    }

    public function payment()
    {
        $data = 'Payment List';
        $da = Paid::where('user',Auth::user()->id)->get();
        return view('user.payment.index',compact('da','data'));   
    }

    public function job()
    {
        $users = Auth::user()->id;  
        $da = Apply::where('users_id',$users)->get();   
        $data = 'Job List';        
        return view('user.job.index',compact('da','data'));   
    }

    public function exam()
    {   
        $test = Test::where('users_id',Auth::user()->id)->where('status',0)->first();
        if($test)
        {
            return redirect()->route('testing',['id'=>md5($test->id)]);
        }
        else
        {
            $stat = Auth::user()->stat;
            $exam = Exam::first();        
            $data = 'Exam';
            $da = Test::where('users_id',Auth::user()->id)->get();
            return view('user.exam.index',compact('da','data','exam'));   
        }

    }

    public function testing($id)
    {   
        $test = Test::where(DB::raw('md5(id)'),$id)->first();
        $data = 'Test '.$test->exam->kelas->name;
        return view('user.exam.test',compact('test','data'));   
    }

    public function test(Request $request, $id)
    {
        $exam = Exam::where(DB::raw('md5(id)'),$id)->first();
       
        if($exam)
        {
           $test = new Test;
           $test->users_id = Auth::user()->id;
           $test->exams_id = $exam->id;
           $test->start    = date('Y-m-d H:i:s');
           $test->save();

           Status::grade($test->users_id,'Exam start',4);
           return redirect()->route('testing',['id'=>md5($test->id)]);
        }
        else
        {
            Alert::error('info', 'invalid Request');
            return back();
        }        
     
    }


    public function tested(Request $request, $id)
    {
        $test = Test::where(DB::raw('md5(id)'),$id)->first();
       
        if($test)
        { 
            $point = 0;
            $q = $request->input('q');
            foreach($q as $key => $item)
            {
                $cc = Question::where('id',$key)->where('key',$item)->exists();
                if($cc)
                {
                    $point +=1;
                }                
            }
            
            $test->val = $point;
            $test->log = json_encode($q);
            $test->end = date('Y-m-d H:i:s');
            $test->status = 1;
            $test->save();

            Status::grade($test->users_id,'Exam Tested',5);     

           return redirect()->route('xam');
        }
        else
        {
            Alert::error('info', 'invalid Request');
            return back();
        }        
     
    }

    public function data(Request $request, $id)
    {

        $rule = [            
            'alamat' => 'required',      
            'place_birth' => 'required',      
            'date_birth' => 'required',     
            'date_birth' => 'required',     
            'date_birth' => 'required',     
            'date_birth' => 'required',                       
            ];

        $request->validate($rule);

        $head = Head::where(DB::raw('md5(id)'),$id)->first();
       
        if($head)
        {   
           $data = new Data;
           $data->users_id = $head->participant;
           $data->alamat = $request->alamat;
           $data->gender = $request->gender;
           $data->place_birth = $request->place_birth;
           $data->date_birth= $request->date_birth;
           $data->married = $request->married;
           $data->religion = $request->religion;
           $data->tall = $request->tall;
           $data->weight = $request->weight;
           $data->blood = $request->blood;
           $data->hobbies = $request->hobbies;
           $data->dad = json_encode([$request->dad,$request->ageDad]);
           $data->mom = json_encode([$request->mom,$request->ageMom]);
           $data->sis = json_encode([$request->sis,$request->ageSis]);
           $data->bro = json_encode([$request->bro,$request->ageBro]);

           if(count($request->job) > 0)
           {
              $job = $request->job;              
              $period = $request->jobPeriod;
              $var = $request->var;

              for ($i=0; $i < count($job); $i++) {       
                if($job[$i] != null)
                {
                    $jobs = [$job[$i],$period[$i],$var[$i]];
                }          
              }

              $data->job = json_encode($jobs);           
           }

           if(count($request->studied) > 0)
           {
              $study = $request->studied;
              $perioded = $request->perioded;     

              for ($i=0; $i < count($study); $i++) {        
                if($study[$i] != null)
                {
                    $studied = [$study[$i],$perioded[$i]];
                }         
              }

              $data->study = json_encode($studied);           
           }   
           $data->save();
           
           Status::grade($head,'Inserted Indentity',3);    
           Alert::success('info', 'insert Fill Data Success');
           return back();
        }
        else
        {
            Alert::error('info', 'invalid Request');
            return back();
        }        
     
    }
}
