@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
<style>
    .imgs{
        object-fit: cover;
    height: 50px;
    width: 80px;
    }
    </style>
@endpush
@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">    
                <h4>{{$data}}</h4>    
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>   
                                <th>Company</th>                                                    
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)            
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->job->name}}</td>                                                                                      
                                <td>
                                    <button type="button" class="btn btn-sm btn-dark rounded-pill" data-bs-toggle="modal" href="#cv{{$item->id}}">CV</button>
                                    @if($item->status == 0)
                                        <button type="button" class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" href="#ver{{$item->id}}">Verifikasi</button>
                                    @else                                                 
                                        @if($item->status == 1)
                                            <button type="button" class="btn btn-sm btn-success rounded-pill">Approve</button>   
                                            <button type="button" class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" href="#in{{$item->id}}">Interview</button>
                                        @elseif($item->status == 2)                                  
                                            <button type="button" class="btn btn-sm btn-danger rounded-pill">Reject</button>   
                                        @else
                                        <button type="button" class="btn btn-sm btn-success rounded-pill">Interviewed</button>   
                                        @endif                              
                                    @endif
                            </td>      
                            </tr>                        
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @foreach($da as $item)
        <div class="modal fade" id="cv{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail CV</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mx-auto d-block">
                        <div class="embed-responsive embed-responsive-1by1">
                            <iframe class="embed-responsive-item" src="{{$item->video}}" allowfullscreen></iframe>
                          </div>
                    </div>                   
                      
                    <a href="{{route('doc',['id'=>md5($item->id)])}}" class="btn icon icon-left btn-primary my-3" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-word" viewBox="0 0 16 16">
                            <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                        </svg>
                        Download
                    </a>                    
                    <iframe frameborder="0" src="{{asset($item->user->cv->file)}}" class="w-100" style="height:600px;width:600px;"  title="cv" allowfullscreen></iframe>                   
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>      
                </div>
              </div>
            </div>
        </div>

        <div class="modal fade" id="ver{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Verifikasi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row mb-3 d-none">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" name="alamat">{{old('alamat')}}</textarea>                                                          
                        </div>

                        <div class="d-flex justify-content-start">
                            <form action="{{route('apply.update',['id'=>md5($item->id)])}}" method="post" enctype="multipart/form-data">    
                                @csrf                    
                                <button class="btn btn-success rounded-pill btn-block">Setuju</button>
                            </form> 
                            <div class="p-1"></div>
                            <form action="{{route('apply.reject',['id'=>md5($item->id)])}}" method="post" enctype="multipart/form-data">    
                                @csrf                    
                                <button class="btn btn-danger rounded-pill btn-block">Tolak</button>
                            </form> 
                        </div>
                    </div>
                </div>              
              </div>
            </div>
        </div>

        <div class="modal fade" id="in{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Set Interview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">                       
                        <form action="{{route('apply.update',['id'=>md5($item->id)])}}" method="post" enctype="multipart/form-data">    
                            @csrf         
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="date" class="form-control" required>                                                       
                            </div>           
                            <button class="btn btn-primary rounded-pill btn-sm w-25">Save</button>
                        </form>                                               
                    </div>
                </div>              
              </div>
            </div>
        </div>
        @endforeach     
    </section>
    <!-- Basic Tables end -->

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>
@endpush