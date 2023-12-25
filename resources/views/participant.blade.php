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
    <h2 class="card-title">Welcome, <span class="text-capitalize">{{auth()->user()->name}}</span> </h2>
</div>
<div class="page-content px-3">
    @include('participant.home')       
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
