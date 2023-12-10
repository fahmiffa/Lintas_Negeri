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
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Selamat Datang, <span class="text-capitalize">{{auth()->user()->name}}</span></h2>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus nemo quasi labore expedita? Veritatis
                at maxime id voluptates excepturi molestiae possimus blanditiis dicta consequuntur maiores suscipit,
                eveniet neque obcaecati doloribus.</p>
                <div class="px-4">
                    <button class="btn btn-block btn-outline-primary font-bold mt-3">Ayo mulai</button>
                </div> 
        </div>
    </div>
</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/dashboard.js')}}"></script>

<script>
    var timeoutAlert = document.getElementById('timeoutAlert');
    setTimeout(function() {
        timeoutAlert.style.display = 'none';
    }, 3000); 
</script>
@endpush
