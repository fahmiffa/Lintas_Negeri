<div class="container">
<ul>                         
    <li
        class="menu-item  ">
        <a href="{{route('home')}}" class='menu-link'>
            <span><i class="bi bi-house-fill"></i> Home</span>
        </a>
    </li>                          
   
 
    <li class="menu-item active has-sub">
        <a href="#" class='menu-link'>
            <span><i class="bi bi-stack"></i> Master</span>
        </a>
        <div class="submenu ">     
            <div class="submenu-group-wrapper">                                
                <ul class="submenu-group">      

                    @if(auth()->user()->hasPermission('master'))        
                    <li class="submenu-item {{ (Request::segment(2)) == 'user' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Users Account  
                        </a>                       
                    </li>
                    @endif

                    
                    @if(auth()->user()->hasPermission('payment'))
                    <li class="submenu-item {{ (request()->routeIs('payment.index')) ? 'active' : null }}">
                        <a href="{{route('payment.index')}}"
                            class='submenu-link'>Payment Method
                        </a>                       
                    </li>   
                    @endif                   

                    @if(auth()->user()->hasPermission('guru'))
                    <li class="submenu-item {{ (Request::segment(2)) == 'class' ? 'active' : null }}">
                        <a href="{{route('class.index')}}"
                            class='submenu-link'>Class
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'exam' ? 'active' : null }}">
                        <a href="{{route('exam.index')}}"
                            class='submenu-link'>Exam
                        </a>                       
                    </li>               
                    @endif

                    @if(auth()->user()->hasPermission('master'))
                    <li class="submenu-item {{ (Request::segment(2)) == 'company' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>LPK
                        </a>                       
                    </li>
                    @endif

                    @if(auth()->user()->hasPermission('job'))
                    <li class="submenu-item {{ (Request::segment(2)) == 'job' ? 'active' : null }}">
                        <a href="{{route('job.index')}}"
                            class='submenu-link'>Pekerjaan
                        </a>                       
                    </li> 
                    @endif
                </ul>                                
            </div>
        </div>
    </li>     

    @if(auth()->user()->hasPermission('payment'))
    <li class="menu-item">
        <a href="{{route('paid.index')}}" class='menu-link active'>
            <span><i class="bi bi-wallet"></i> Pembayaran</span>
        </a>
    </li>                    
    @endif

    @if(auth()->user()->hasPermission('verif'))    
    <li class="menu-item">
        <a href="{{route('kelas.index')}}" class='menu-link active'>
            <span><i class="bi bi-bookmark-star-fill"></i> Kelas</span>
        </a>
    </li>      
     <li class="menu-item">
        <a href="{{route('apply.index')}}" class='menu-link active'>
            <span><i class="bi bi-bookmark-check-fill"></i> Pekerjaan</span>
        </a>
    </li>                    
    @endif
</ul>
</div>

