<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WMS</title>

    <!-- Scripts -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="{{asset('frontend/js/countrypicker\js\countrypicker.js')}}"></script>
    <script src="{{asset('frontend/js/countrypicker\js\countrypicker.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> --}}
    
    <script src="{{asset('frontend/js/bootstrap5.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/additional-methods.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('frontend/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        // // override jquery validate plugin defaults
        // $.validator.setDefaults({
        //     highlight: function(element) {
        //         $(element).closest('.form-group').addClass('has-error');
        //     },
        //     unhighlight: function(element) {
        //         $(element).closest('.form-group').removeClass('has-error');
        //     },
        //     errorElement: 'span',
        //     errorClass: 'text-danger',
        //     errorPlacement: function(error, element) {
        //         if(element.parent('.input-group').length) {
        //             error.insertAfter(element.parent());
        //         } else {
        //             error.insertAfter(element);
        //         }
        //     }
        // });
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">





    <!-- Styles -->
    <link href="{{ asset('frontend\css\bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend\css\fontawesome\css\all.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend\css\jquery.multiselect.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend\css\countrypicker\css\flags') }}" rel="stylesheet">
    <link href="{{ asset('frontend\dropzone\min\dropzone.min.css') }}" rel="stylesheet">
    
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons --
  <link rel="stylesheet" href={{asset('frontend/plugins/fontawesome-free/css/all.min.css')}}>
  <-- Theme style -->
</head>
<style>
    </style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if(!empty(Auth::user()))
        <div class="mt-1">
        @include('layouts.navbar')
        </div>
        @endif
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@yield('script')
</html>
