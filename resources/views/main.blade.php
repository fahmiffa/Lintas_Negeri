@extends('layout.base')     
@section('main')
<div class="page-heading">
    @if(session('error'))
    <div class="alert alert-danger" id="timeoutAlert" role="alert">
            {{ session('error') }}
        </div>
    @endif
</div>
<div class="page-content">
<section class="row">
    <div class="col-12">
        @if(auth()->user()->hasPermission('lpk'))    
            <div class="row">
                <div class="col-md-3 d-none d-md-block">        
                    <div class="card card-body">
                        <div class="flex-row">
                            <div class="col-12">
                            <div class="p-1 mb-3">
                                <h6 class="text-muted font-semibold">Total Siswa</h6>
                                <h6 class="font-extrabold mb-0">100</h6>
                            </div>                   
                            </div>   
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-4 col-6 mb-3">
                                <a href="{{route('student.index')}}">
                                    <div class="d-flex flex-column">                  
                                        <div class="stats-icon blue mb-2 mx-auto">
                                            <i class="iconly-boldActivity"></i>
                                        </div>                     
                                        <h6 class="font-extrabold mb-0 text-center text-wrap">Siswa</h6>            
                                    </div>
                                </a>
                            </div>                                      
                        </div>            
                    </div>
                </div>
            </div>
        @endif
        @if(auth()->user()->hasPermission('master'))
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Participant</h6>
                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Company</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Job</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Worker</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Report</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                        
                    </div>
                </div>
            </div>   
        @endif
        @if(auth()->user()->hasPermission('payment'))
            <div class="row">
                <div class="col-md-3 d-none d-md-block">        
                    <div class="card card-body">
                        <div class="flex-row">
                            <div class="col-12">
                            <div class="p-1 mb-3">
                                <h6 class="text-muted font-semibold">Total Verifikasi</h6>
                                <h6 class="font-extrabold mb-0">100</h6>
                            </div>                   
                            </div>   
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-4 col-6 mb-3">
                                <a href="{{route('paid.index')}}">
                                    <div class="d-flex flex-column">                  
                                        <div class="stats-icon blue mb-2 mx-auto">
                                            <i class="iconly-boldActivity"></i>
                                        </div>                     
                                        <h6 class="font-extrabold mb-0 text-center text-wrap">Verifikasi Pembayaran</h6>            
                                    </div>
                                </a>
                            </div>                                      
                        </div>            
                    </div>
                </div>
            </div>
        @endif
        @if(auth()->user()->hasPermission('verif'))
        <div class="row">
            <div class="col-md-3 d-none d-md-block">        
                <div class="card card-body">
                    <div class="flex-row">
                        <div class="col-12">
                        <div class="p-1 mb-3">
                            <h6 class="text-muted font-semibold">Total Kelas</h6>
                            <h6 class="font-extrabold mb-0">100</h6>
                        </div>  
                        <div class="p-1 mb-3">
                            <h6 class="text-muted font-semibold">Total Pekerjaan</h6>
                            <h6 class="font-extrabold mb-0">100</h6>
                        </div>                   
                        </div>   
                    </div> 
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card card-body">
                    <div class="row">                    
                        <div class="divider divider-center">
                            <div class="divider-text h6">Verifikasi</div>
                        </div>
                        <div class="col-md-4 col-6 mb-3">
                            <a href="{{route('kelas.index')}}">
                                <div class="d-flex flex-column">                  
                                    <div class="stats-icon blue mb-2 mx-auto">
                                        <i class="iconly-boldActivity"></i>
                                    </div>                     
                                    <h6 class="font-extrabold mb-0 text-center text-wrap">Kelas</h6>            
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6 mb-3">
                            <a href="{{route('apply.index')}}">
                                <div class="d-flex flex-column">                  
                                    <div class="stats-icon blue mb-2 mx-auto">
                                        <i class="iconly-boldCategory"></i>
                                    </div>                     
                                    <h6 class="font-extrabold mb-0 text-center text-wrap">CV</h6>            
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6 mb-3">
                            <a href="{{route('interview.index')}}">
                                <div class="d-flex flex-column">                  
                                    <div class="stats-icon blue mb-2 mx-auto">
                                        <i class="iconly-boldTicket"></i>
                                    </div>                     
                                    <h6 class="font-extrabold mb-0 text-center text-wrap">Interview</h6>            
                                </div>
                            </a>
                        </div>                                      
                    </div>            
                </div>
            </div>
        </div>
    @endif
    </div> 
</section>
</div>
@endsection

@push('js')    
<script>

@if(session('error'))
    var timeoutAlert = document.getElementById('timeoutAlert');
    setTimeout(function() {
        timeoutAlert.style.display = 'none';
    }, 3000); 
@endif
    
</script>

<script src="https://zuramai.github.io/mazer/demo/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="https://zuramai.github.io/mazer/demo/assets/static/js/pages/dashboard.js"></script>
@endpush
