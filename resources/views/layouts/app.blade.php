<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SellOut - The best website to sell your stuff</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet">
</head>

<body>

    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container">
                <div class="col-lg-2">
                    <div class="row">
                        <a class="navbar-brand ml-2" href="{{ url('/') }}">
                            <b>SellOut</b>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto col-md-2">
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-2">
                                <!-- Authentication Links -->
                                @guest
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('register') }}"><b>{{ __('Register') }}</b></a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <b>{{ Auth::user()->name }}</b><span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{url('/myAds')}}"><b>My Ads</b></a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                <b>{{ __('Logout') }}</b>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @auth
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url('/post-classified-ads')}}"><b>{{ __('Post') }}</b></a>
                                </li>
                                @endauth
                                @endguest

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <form class="form-horizontal" method="POST" action="{{url('/product/search')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-8">
                                        <input class="form-control" type="text" placeholder="Search product..." id="searchonproduct" name="searchonproduct" required="true">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-default" type="submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <form class="form-horizontal" method="POST" action="{{url('/search/advertisement')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="Search by council..." id="state" name="state" required="true">
                                        <div class="dropdown categories" id="stateList"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control dropdown categories" id="categories" name="categories" required="true">
                                            <option>Select...</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <input class="btn btn-default" type="submit" placeholder="Search" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript">
        //list councils under text box 
        $(document).ready(function() {
            $("#state").keyup(function() {
                var data;
                var states = $(this).val();
                if (states != "") {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('searchlocation.fetch') }}",
                        method: "POST",
                        data: {
                            states: states,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $("#stateList").fadeIn();
                            $("#stateList").html(data);
                        }
                    })
                } else {
                    $("#stateList").fadeOut();
                    $("#stateList").html(data);
                }
            });
            $(document).on('click', '#search', function() {
                $("#state").val($(this).text());
                $("#stateList").fadeOut();
            })
        });

        //list categories under text box
        $(document).ready(function() {
            $.ajax({
                url: "{{route('categories.retrieve')}}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#categories').fadeIn();
                    $('#categories').html(data);
                }
            })
        });

        $(document).ready(function() {
            if (window.location == "https://b00331418.herokuapp.com") {
                $.ajax({
                    url: "{{route('categories.ads')}}",
                    method: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#Advertisements').html(data);
                    }
                })
            }
        });

        // $(document).ready(function() {
        //     if (window.location == 'http://localhost/myAds') {
        //         $.ajax({
        //             url: "{{route('categories.ads')}}",
        //             method: "GET",
        //             data: {
        //                 "_token": "{{ csrf_token() }}"
        //             },
        //             success: function(data) {
        //                 $('#myAds').html(data);
        //             }
        //         })
        //     }
        // });
    </script>

</body>

</html>