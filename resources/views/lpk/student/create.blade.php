@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">

@endpush
@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{$data}}</h3>                
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

                @isset($student)
                <form action="{{route('student.update',['student'=>$student])}}" method="post">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('student.store')}}" method="post">                               
                @endif                    
                    @csrf           
                    <div class="px-5">               
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Siswa</label>                       
                            <div class="col-md-6">
                                <select class="choices form-select" name="account">
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}"  @selected(isset($student) && $student->student == $item->id)>{{ucfirst($item->name)}}</option>
                                    @endforeach                       
                                </select>
                                @error('account')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                        
                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger ms-3" href="{{route('student.index')}}">Back</a>
                        </div>
                    </div>             
                </form>
            </div>
        </div>

    </section>

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>

<script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/static/js/pages/form-element-select.js')}}"></script>

@endpush