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
                                <th>Kelas</th> 
                                <th>Point</th>                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)                            
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->test->exam->kelas->name}}</td>
                                <td>{{$item->test->val}}</td>                                                                        
                                <td>
                                    @if($item->offline == 1)
                                        <button type="button" class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i></button>
                                    @elseif($item->user->stat == 5)                                    
                                        <form onsubmit="return confirm('Apakah Anda Yakin Memverifikasi menjadi kelas Offline?');" action="{{ route('kelas.update', md5($item->id)) }}" method="POST">@csrf                                                                    
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-check-lg"></i></button>
                                        </form>
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
        <div class="modal fade" id="open{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail payment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('assets/image/'.$item->img)}}" class="w-75">
                    <p>Waktu : {{$item->created_at}}</p>              
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>      
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