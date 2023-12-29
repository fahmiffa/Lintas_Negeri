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
                                <th>Class</th>
                                <th>File</th>      
                                <th>Nominal</th>      
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->users->name}}</td>
                                <td>{{$item->kelas->name}}</td>
                                <td>
                                    <a data-bs-toggle="modal" href="#open{{$item->id}}">
                                        <img src="{{asset('assets/image/'.$item->img)}}" class="imgs">
                                    </a>
                                </td>
                                <td>{{number_format($item->kelas->price,0,",",".")}}</td>                                                                        
                                <td>
                                    {!! ($item->status == 1) ? '' : '' !!}
                                    @if($item->status == 0)
                                        <span class="badge bg-warning">On progress</span>
                                    @elseif($item->status == 1)
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-danger">Reject</span>
                                    @endif
                                </td>                                                  
                                <td>
                                    @if($item->status == 0)
                                        <button type="button" class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" href="#ver{{$item->id}}">Verifikasi</button>
                                    @else                                                             
                                        <button type="button" class="btn btn-sm btn-success rounded-pill">Telah diverifikasi</button>
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

            <div class="modal fade" id="ver{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">              
                            <p class="">Anda akan mengubah status pembayaran ?</p>
                            <div class="d-flex justify-content-start">
                                <form action="{{ route('paid.update', md5($item->id)) }}" method="POST">    
                                @method('PATCH')                                        
                                    @csrf                    
                                    <button class="btn btn-success rounded-pill btn-block">Setuju</button>
                                </form> 
                                <div class="p-1"></div>
                                {{-- <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" href="#reject{{$item->id}}">Tolak</button>                         --}}
                            </div>
                        </div>
                    </div>              
                </div>
                </div>
            </div>

            <div class="modal fade" id="reject{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Verifikasi di Tolak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="{{ route('paid.reject', ['id'=>md5($item->id)]) }}" method="POST">    
                                @csrf    
                                <div class="form-group row mb-3">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="2" name="ket" required>{{old('ket')}}</textarea>   
                                    <small class="text-danger">Masukan Keterangan jika pembayaran, di tolak</small>                                                       
                                </div>
                                <button class="btn btn-danger rounded-pill">Tolak</button>
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