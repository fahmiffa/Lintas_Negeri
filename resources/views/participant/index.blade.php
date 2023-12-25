@extends('layout.base')     
@section('main')
<div class="page-heading px-3">
    <h2 class="card-title">{{$data}}</h2>
</div>
<div class="page-content">
    <div class="card card-body px-5">
        @php
            // varifikasi pembayaran
            $st = auth()->user()->stat;    
            $pay =[1,4]; 

            // state 
            $state = [8,9,11];
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
                <div class="divider divider-center">
                    <div class="divider-text h6">{{auth()->user()->state}}</div>
                </div>
                @if($apply)                
                    <p class="text-center text-danger">{{date('d-M-Y',strtotime($apply->interview))}}</p>
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

@endsection