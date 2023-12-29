@extends('layout.base')     
@section('main')
<div class="page-heading px-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">    
            <h4>{{$data}}</h4>    
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            @if($head)
            <p class="text-muted small float-end">Nomor Registrasi : {{$head->registrasi}}</p>
            @endif
        </div>
    </div>  
</div>
<div class="page-content">
    <div class="card">
    <div class="card-body px-5">
        @php
            // varifikasi pembayaran
            $st = auth()->user()->stat;    
            $pay =[1,4]; 

            // state 
            $state = [8,9];
        @endphp
        @if($head)
        <div class="flex-row"> 
            @if(in_array($st,$pay))
                <div class="divider divider-center">
                    <div class="divider-text h6"> {{Auth()->user()->state}}</div>
                </div>
            @elseif($st == 2)              
                @include('participant.identitas');       
            @elseif($st == 3)        
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>                    
                </div>
                <form action="{{route('daftar.store',['id'=>md5($exam->id)])}}" method="post">
                    @csrf
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Start Test" class="btn btn-secondary mx-auto d-block"><i class="bi bi-file-text"></i> Test</button>
                </form>
            @elseif($head->offline != 1 && $st == 5)  
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>                    
                </div>      
            @elseif($head->offline == 1 && $st == 5)
                <div class="divider divider-left-center">
                    <div class="divider-text h6">Pembayaran {{$kelas->name}}</div>
                </div>
                @include('participant.kelas');              
            @elseif($st == 6) 
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>                    
                </div>      
            @elseif($st == 7)  
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>                    
                </div>
                @include('participant.job');     
            @elseif(in_array($st,$state))  
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>                    
                </div>   
            @elseif($st == 10)
                <div class="divider divider-left">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>
                </div>
                @if($apply)                
                <div class="table-responsive w-50">
                    <table class="table table-borderless">          
                        <tbody>
                          <tr>
                            <td>Tanggal</td>
                            <td>: {{date('d-M-Y',strtotime($apply->interview))}}</td>             
                          </tr>
                          <tr>
                            <td>Tempat</td>
                            <td>: {{$apply->job->name}}, {{$apply->job->interview}}</td>   
                          </tr>         
                        </tbody>
                    </table>                          
                </div>
                @endif
            @elseif($st == 11 && $head->job == 1)
                <div class="divider divider-left-center">
                    <div class="divider-text h6">Pembayaran {{$kelas->name}}</div>
                </div>
                @include('participant.kelas');  
            @elseif($st == 11 && $head->job != 1)
                <div class="divider divider-center">
                    <div class="divider-text h6 text-danger">{{auth()->user()->state}}</div>
                    <p>Anda akan kembali ke Offline Class</p>
                </div>
           
            @elseif($st == 13 && $head->work == 1)
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>
                </div>
                @if($apply)                
                <div class="table-responsive w-25">
                    <table class="table table-borderless">          
                        <tbody>
                            <tr>
                            <td>Perushaan</td>
                            <td>: {{$apply->job->name}}</td>             
                            </tr>
                            <tr>
                            <td>Bagian</td>
                            <td>: {{$apply->job->section}}</td>   
                            </tr>         
                        </tbody>
                    </table>                          
                </div>
                @endif
            @else
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>
                </div>
                @foreach($head->participants as $item)
                        <div class="d-flex justify-content-between mb-3 d-none">
                            <div class="p-1">
                                <h6 class="text-muted font-semibold">{{$item->state}}</h6>                                                 
                            </div>
                            <div class="p-1">                                              
                                <h6 class="font-extrabold mb-0 text-primary">{{date('m-d-Y',strtotime($item->created_at))}}</h6>
                            </div>                                 
                        </div>
                    @endforeach
            @endif
        </div>    
        @else
            <div class="divider divider-left-center">
                <div class="divider-text h6">Pembayaran {{$kelas->name}}</div>
            </div>
            @include('participant.kelas');             
        @endif  
    </div>
</div>
</div>

@endsection