<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
</head>

<style>
    .sub-nav {
        padding-right: 10px;
        height: 28px;
    }

    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #282828;
        min-width: 90px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-layout: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #9f9e9e;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>

<body>

    {{-- @if (request()->user()->role == 0)  --}}
    <div class="wrapper">
        <div class="row gx-0">
            <div class="super col-sm-2" style="background: black;">
                <div class="sidebar">
                    <img style="width: 70px ;height: 70px; margin-left:50px "
                        src="https://images.complex.com/complex/images/c_crop,h_920,w_1636,x_109,y_0/c_fill,g_center,h_640,w_640/fl_lossy,pg_1,q_auto/ryd9nmid8thz3xe4vda8/spotify-logo"
                        alt="">
                    <ul class="nav-sidebar">
                        <li>
                            <i class="fas fa-home icon"></i>
                            <a style="color: #fff;" href="{{ route('client.index') }}">Home</a>
                        </li>
                        <li>
                            <i class="fas fa-search icon"></i>
                            <a href="{{ route('client.searchSong') }}" onclick="clickSearch()">Search</a>
                        </li>
                        <li>
                            <i class="fas fa-book icon"></i>
                            <a href="">Your library</a>
                        </li>
                    </ul>
                    <ul class="nav-sidebar">
                        <li>
                            <i class="fas fa-plus icon"></i>
                            <a href="{{ route('client.addPlaylist') }}">Add playlist</a>
                        </li>
                        <li>
                            <i class="fas fa-heart icon"></i>
                            <a href="{{route('client.likesong')}}">Liked Songs</a>
                        </li>
                    </ul>
                    <div class="underlined"></div>
                </div>
            </div>
            <div class="col-sm-10 container" style="background:#282828">
                <div class="navigation" style="display: flex; width: 100%;background: #070909">
                    <div class="search" style="flex: 1; color: #ffff;">
                        @section('searchSong')

                        @show
                    </div>
                    @if( auth()->check() )
                        <div class="sub-nav">
                            <div class="dropdown">
                                <div class="dropdown-content" style="margin-top: 38px;">
                                    <a href="{{route('auth.profile')}}" style="display: flex;"><i style="padding:3px 10px"
                                            class="fa-regular fa-user"></i>
                                        <p style="padding-right: 30px;font-size: 16px">Profile</p>
                                    </a>
                                    @if (request()->user()->role == 1 || request()->user()->role == 2)
                                    <a href="{{route('admin.layout')}}" style="display: flex;"><i style="padding:3px 10px"
                                        class="fa-sharp fa-solid fa-unlock"></i>
                                        <p style="padding-right: 30px;font-size: 16px">Admin</p>
                                    </a>
                                    @endif
                                    <form action="" method="post">
                                        @csrf
                                        <a href="{{route('auth.logout')}}" style="display: flex;">
                                            <i style="padding:3px 10px"
                                                class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i>
                                            <p style="font-size: 16px;padding-right: 30px">Logout</p>
                                        </a>
                                    </form>
                                </div>
                                <a href="">
                                    <div style="display: flex;background: #000000;padding:3px 10px;">
                                        @if (isset($profile->avatar))
                                        <img src=" {{$profile->avatar}}" alt="" style="width:30px;height:30px;border-radius: 50%;object-fit: cover">
                                        <label style="padding-left: 5px;font-size: 17px">{{$profile->name}}</label>
                                        @endif   
                                        @if (!isset($profile->avatar))
                                        <img src="" alt="" style="width:30px;height:30px;border-radius: 50%;object-fit: cover">
                                        <label style="padding-left: 5px;font-size: 17px">{{$users->name}}</label>
                                        @endif   
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if( !auth()->check() )
                        <div class="sub-nav" style="padding-right:5px;">
                            <a href="{{ route('auth.register') }}">Đăng ký</a>
                            <a class="login" href="{{ route('auth.login') }}">Đăng nhập</a>
                        </div>
                    @endif
                </div>
                <div class="content" >
                    @section('main-content')
                    @show
                </div>
            </div>
        </div>
        <div class="footer" style="display: none">
            @section('main-footer')
            @show
        </div>
    </div>
    {{-- @endif --}}

</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('client/js/app.js') }}"></script>

</html>
