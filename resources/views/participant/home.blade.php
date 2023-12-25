<div class="row">
    <div class="col-md-3 d-none d-md-block">        
        <div class="card card-body">
            <div class="flex-row">
                <div class="col-12">
                  <div class="p-1 mb-3">
                    <h6 class="text-muted font-semibold">Total Job</h6>
                    <h6 class="font-extrabold mb-0">100</h6>
                  </div>
                  <div class="p-1 mb-3">
                    <h6 class="text-muted font-semibold">Total Company</h6>
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
                <div class="col-md-4 col-6 mb-3">
                    <a href="{{route('kelas')}}">
                        <div class="d-flex flex-column">
                            @php
                                if($head)
                                {
                                    if($head->status == 4 || $head->status == 3)
                                    {
                                        $bg = 'red';
                                    }
                                    else {
                                        $bg = 'green';
                                    }
                                }
                                else {
                                    $bg = 'blue';
                                }
                            @endphp
                            <div class="stats-icon {{$bg}} mb-2 mx-auto">
                                <i class="iconly-boldActivity"></i>
                            </div>                     
                            <h6 class="font-extrabold mb-0 text-center text-wrap">Daftar Kelas</h6>            
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 mb-3">
                    <a href="{{route('pay')}}">
                        <div class="d-flex flex-column">
                            <div class="stats-icon blue mb-2 mx-auto">
                                <i class="iconly-boldBookmark"></i>
                            </div>                     
                            <h6 class="font-extrabold mb-0 text-center">Pembayaran</h6>            
                        </div>    
                    </a>
                </div>    
                <div class="col-md-4 col-6 mb-3">
                    <a href="{{route('xam')}}">
                        <div class="d-flex flex-column">
                            <div class="stats-icon blue mb-2 mx-auto">
                                <i class="iconly-boldPaper"></i>
                            </div>                     
                            <h6 class="font-extrabold mb-0 text-center">Ujian</h6>            
                        </div>    
                    </a>
                </div>   
                <div class="col-md-4 col-6 mb-3">
                    <a href="{{route('jobs')}}">
                        <div class="d-flex flex-column">
                            <div class="stats-icon blue mb-2 mx-auto">
                                <i class="iconly-boldTicket-Star"></i>
                            </div>                     
                            <h6 class="font-extrabold mb-0 text-center">Pekerjaan</h6>            
                        </div>    
                    </a>
                </div>                
            </div>            
        </div>
    </div>
</div>