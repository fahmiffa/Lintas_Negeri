<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $title = str_replace("_"," ",env('APP_NAME')); @endphp
    <title>{{ $title }}</title>          
    <link rel="shortcut icon" href="{{asset('icon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/auth.css')}}">

    <style>
        #auth {              
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1152%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(21%2c 67%2c 96%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c498.577C105.527%2c490.969%2c213.141%2c524.48%2c310.598%2c483.299C417.38%2c438.177%2c538.737%2c371.377%2c567.054%2c258.965C595.682%2c145.317%2c480.616%2c48.24%2c448.588%2c-64.497C422.223%2c-157.298%2c442.785%2c-258.766%2c395.998%2c-343.134C342.768%2c-439.121%2c276.517%2c-556.891%2c167.675%2c-571.05C56.356%2c-585.532%2c-13.344%2c-443.835%2c-120.482%2c-410.323C-224.589%2c-377.759%2c-352.873%2c-447.006%2c-439.756%2c-381.051C-527.207%2c-314.665%2c-546.549%2c-189.312%2c-555.747%2c-79.904C-564.607%2c25.487%2c-525.771%2c124.309%2c-490.626%2c224.062C-452.086%2c333.453%2c-441.993%2c473.627%2c-340.777%2c530.259C-239.161%2c587.115%2c-116.14%2c506.95%2c0%2c498.577' fill='%230e2c3e'%3e%3c/path%3e%3cpath d='M1440 1082.4969999999998C1552.357 1104.972 1671.762 1129.87 1776.782 1084.0430000000001 1888.179 1035.433 1976.4180000000001 938.571 2025.067 827.191 2073.3360000000002 716.679 2074.906 589.672 2043.577 473.219 2014.248 364.201 1929.686 285.064 1856.17 199.387 1782.278 113.27199999999999 1722.6390000000001 0.010999999999967258 1612.869-28.738000000000056 1503.591-57.35799999999995 1396.798 12.696000000000026 1290.623 51.26799999999997 1191.27 87.36099999999999 1080.558 108.68299999999999 1012.335 189.426 944.4100000000001 269.817 948.246 383.442 923.518 485.741 895.864 600.143 803.017 721.769 858.573 825.529 914.812 930.5640000000001 1070.969 916.4929999999999 1179.944 964.656 1268.791 1003.923 1344.75 1063.444 1440 1082.4969999999998' fill='%231c5a82'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1152'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="auth">       
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="mt-5 mx-5 card card-body shadow-sm">
                    <h1 class="text-center" style="font-size: 5rem"><i class="bi bi-globe-asia-australia"></i></h1>                    
                    <h1 class="auth-title text-center">{{$title}}</h1>
                    <br>
                    <p class="auth-subtitle mb-3 text-justify">Input your data to register to our website</p>

                    @if(session('error'))
                    <div class="alert alert-danger" id="timeoutAlert" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{route('daftar')}}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="user" class="form-control form-control-xl" value="{{old('user')}}" name="user" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('user')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" value="{{old('email')}}" name="email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="number" name="hp"  value="{{old('hp')}}" class="form-control form-control-xl" placeholder="Nomor HP">
                            <div class="form-control-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                            @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>   
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>   
                        <p>Sudah punya akun ?
                            <a href="{{route('login')}}" class="badge bg-dark rounded-pill">Login</a>
                        </p>              
                        <button class="btn btn-primary btn-block rounded-pill shadow-lg mt-3">Daftar</button>
                    </form>
                </div>
            </div>   
        </div>
    </div>

        
@if(session('error'))
    <script>
    
        var timeoutAlert = document.getElementById('timeoutAlert');
    
        setTimeout(function() {
            timeoutAlert.style.display = 'none';
        }, 3000); 
    </script>
@endif


@include('sweetalert::alert')
</body>
</html>