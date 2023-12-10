<div class="container">
<ul>                         
    <li
        class="menu-item  ">
        <a href="{{route('home')}}" class='menu-link'>
            <span><i class="bi bi-house-fill"></i> Home</span>
        </a>
    </li>                          
   
    {{-- <li
        class="menu-item  has-sub">
        <a href="#" class='menu-link'>
            <span><i class="bi bi-stack"></i> Components</span>
        </a>
        <div
            class="submenu ">
            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
            <div class="submenu-group-wrapper">
                
                
                <ul class="submenu-group">
                    
                    <li
                        class="submenu-item  ">
                        <a href="component-alert.html"
                            class='submenu-link'>Alert</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-badge.html"
                            class='submenu-link'>Badge</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-breadcrumb.html"
                            class='submenu-link'>Breadcrumb</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-button.html"
                            class='submenu-link'>Button</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-card.html"
                            class='submenu-link'>Card</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-carousel.html"
                            class='submenu-link'>Carousel</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-collapse.html"
                            class='submenu-link'>Collapse</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-dropdown.html"
                            class='submenu-link'>Dropdown</a>

                        
                    </li>
                    
                </ul>
                
                
                
                <ul class="submenu-group">
                    
                    <li
                        class="submenu-item  ">
                        <a href="component-list-group.html"
                            class='submenu-link'>List Group</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-modal.html"
                            class='submenu-link'>Modal</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-navs.html"
                            class='submenu-link'>Navs</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-pagination.html"
                            class='submenu-link'>Pagination</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-progress.html"
                            class='submenu-link'>Progress</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-spinner.html"
                            class='submenu-link'>Spinner</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  ">
                        <a href="component-tooltip.html"
                            class='submenu-link'>Tooltip</a>

                        
                    </li>
                    
                
                
                    <li
                        class="submenu-item  has-sub">
                        <a href="#"
                            class='submenu-link'>Extra Components</a>

                        
                        <!-- 3 Level Submenu -->
                        <ul class="subsubmenu">
                            
                            <li class="subsubmenu-item ">
                                <a href="extra-component-avatar.html" class="subsubmenu-link">Avatar</a>
                            </li>
                            
                            <li class="subsubmenu-item ">
                                <a href="extra-component-comment.html" class="subsubmenu-link">Comment</a>
                            </li>
                            
                            <li class="subsubmenu-item ">
                                <a href="extra-component-sweetalert.html" class="subsubmenu-link">Sweet Alert</a>
                            </li>
                            
                            <li class="subsubmenu-item ">
                                <a href="extra-component-toastify.html" class="subsubmenu-link">Toastify</a>
                            </li>
                            
                            <li class="subsubmenu-item ">
                                <a href="extra-component-rating.html" class="subsubmenu-link">Rating</a>
                            </li>
                            
                            <li class="subsubmenu-item ">
                                <a href="extra-component-divider.html" class="subsubmenu-link">Divider</a>
                            </li>
                            
                        </ul>
                        
                    </li>
                    
                </ul>
                
                
            </div>
        </div>
    </li>                             --}}

    @if(auth()->user()->master())
    <li class="menu-item active has-sub">
        <a href="#" class='menu-link'>
            <span><i class="bi bi-stack"></i> Master</span>
        </a>
        <div class="submenu ">     
            <div class="submenu-group-wrapper">                                
                <ul class="submenu-group">                    
                    <li class="submenu-item {{ (Request::segment(2)) == 'user' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Users Account  
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'payment' ? 'active' : null }}">
                        <a href="{{route('class.index')}}"
                            class='submenu-link'>Payment Method
                        </a>                       
                    </li>            
                    <li class="submenu-item {{ (Request::segment(2)) == 'class' ? 'active' : null }}">
                        <a href="{{route('class.index')}}"
                            class='submenu-link'>Class
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'exam' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Exam
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'question' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Question
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'teacher' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Teacher
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'company' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Company
                        </a>                       
                    </li>
                    <li class="submenu-item {{ (Request::segment(2)) == 'job' ? 'active' : null }}">
                        <a href="{{route('user.index')}}"
                            class='submenu-link'>Job
                        </a>                       
                    </li> 
                </ul>                                
            </div>
        </div>
    </li>     
    <li class="menu-item">
        <a href="{{route('kelas')}}" class='menu-link active'>
            <span><i class="bi bi-box-arrow-right"></i> Class</span>
        </a>
    </li>                    
    @endif

    @if(auth()->user()->participant())      
    <li class="menu-item">
        <a href="#" class='menu-link disabled'>
            <span><i class="bi bi-send-fill"></i> Job</span>
        </a>
    </li> 
    <li class="menu-item">
        <a href="#" class='menu-link disabled'>
            <span><i class="bi bi-file-text"></i> Exam</span>
        </a>
    </li>   
    <li class="menu-item">
        <a href="#" class='menu-link disabled'>
            <span><i class="bi bi-wallet-fill"></i> Payment</span>
        </a>
    </li>                    
    @endif

</ul>
</div>

