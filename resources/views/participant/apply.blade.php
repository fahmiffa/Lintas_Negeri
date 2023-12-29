@extends('layout.base')     
@section('main')
<div class="page-heading px-3">
    <h2 class="card-title">{{$data}}</h2>
</div>
<div class="page-content">
    <div class="card card-body px-5">
        <div class="row p-3">     
            <div class="col-lg-12 col-12 mb-3">
                <h6>Keterangan</h6>
                {{$job->note}} 
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Position</h6>
                {{$job->section}} 
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Kouta</h6>
                <small>{{$job->kouta}} </small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Salary</h6>
                {{number_format($job->salary,0,",",".")}}
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Alamat</h6>
                <small>{{$job->address}} </small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Tanggal</h6>
                <small>{{$job->open}} - {{$job->close}}</small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Interview</h6>
                <small>{{$job->interview}}</small>
            </div>    
        </div>

        @if($cv)
            <button type="button" class="btn btn-dark btn-sm w-25 rounded-pill my-3" data-bs-toggle="modal" data-bs-target="#myModal">CV</button>
            <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
            <div class="modal-dialog  modal-dialog-centered modal-lg">
                <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-capitalize">CV {{auth()->user()->name}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            
                <!-- Modal body -->
                <div class="modal-body">
                    <iframe frameborder="0" src="{{asset($cv->pdf)}}" class="w-100" style="height:600px;width:600px;"  title="cv" allowfullscreen></iframe>                
                </div>
            
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            
                </div>
            </div>
            </div>
        
        @else        
            <form action="{{route('cv')}}" method="post" enctype="multipart/form-data">    
                @csrf
                <button class="btn btn-dark btn-sm w-25 rounded-pill my-3">Generate CV</button>
            </form> 
        @endif
        
        <form action="{{route('daftar.store', ['id'=>md5($job->id)])}}" method="post" enctype="multipart/form-data">    
            @csrf
        <div class="form-group row mb-3 w-50">
            <label>Link Video</label>
                <input type="text" name="vid" value="{{old('vid')}}" class="form-control" placeholder="Link Video" required>
            @error('vid')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
            <button class="btn btn-primary btn-sm w-25 rounded-pill">Apply</button>
        </form> 
    </div>
</div>

@endsection