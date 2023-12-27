@extends('layout.base')     
@section('main')
<div class="page-heading px-3">
    @if(session('error'))
    <div class="alert alert-danger" id="timeoutAlert" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" id="timeoutAlert" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
        @endif  
</div>
<div class="page-content px-3">
<div class="row">
    <div class="col-md-3 d-none d-md-block">        
        <div class="card card-body">
            <div class="flex-row">
                <h6 class="text-danger">Unverified</h6>
                <div class="col-12">
                  <div class="p-1 mb-3">
                    <h6 class="text-muted font-semibold">Kelas</h6>
                    <h6 class="font-extrabold mb-0">10</h6>
                  </div>
                  <div class="p-1 mb-3">
                    <h6 class="text-muted font-semibold">Pekerjaan</h6>
                    <h6 class="font-extrabold mb-0">5</h6>
                  </div>    
                  <div class="p-1 mb-3">
                    <h6 class="text-muted font-semibold">Interview</h6>
                    <h6 class="font-extrabold mb-0">3</h6>
                  </div>
                </div>   
            </div> 
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card card-body">
            @if(auth()->user()->hasPermission('verif'))               
                <div class="row">
                    <div class="col-md-4 col-6 mb-3">
                        <a href="{{route('job.index')}}">
                            <div class="d-flex flex-column">
                                <div class="stats-icon red mb-2 mx-auto">
                                    <i class="iconly-boldPaper"></i>
                                </div>                     
                                <h6 class="font-extrabold mb-0 text-center">Master Kelas</h6>            
                            </div>    
                        </a>
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
                                    <i class="iconly-boldBookmark"></i>
                                </div>                     
                                <h6 class="font-extrabold mb-0 text-center">Pekerjaan</h6>            
                            </div>    
                        </a>
                    </div>                                                  
                </div>            
            @endif
        </div>
    </div>
</div>
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

    @if ($errors->any())
    var timeoutAlert = document.getElementById('timeoutAlert');
            setTimeout(function() {
                timeoutAlert.style.display = 'none';
            }, 5000);     
    @endif
</script>
@endpush
