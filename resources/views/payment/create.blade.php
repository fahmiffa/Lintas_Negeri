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
                {{-- <p class="text-subtitle text-muted">Powerful interactive tables</p> --}}
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

                @isset($payment)
                <form action="{{route('payment.update',['payment'=>$payment])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('payment.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{isset($payment) ? $payment->name : old('name')}}"   class="form-control">
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Type</label>
                            <div class="col-md-6">
                                <input type="text" name="type" value="{{isset($payment) ? $payment->type : old('type')}}"   class="form-control">
                                @error('type')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Numbers</label>
                            <div class="col-md-6">
                                <input type="text" name="numbers" value="{{isset($payment) ? $payment->numbers : old('numbers')}}"   class="form-control">
                                @error('numbers')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger ms-3" href="{{route('payment.index')}}">Back</a>
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

<script>
    var dengan_rupiah = document.getElementById('price');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value);
    });
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? + rupiah : '');
    }
</script>
@endpush