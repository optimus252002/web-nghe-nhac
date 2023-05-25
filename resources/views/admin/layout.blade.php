<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Star Admin2</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/feather/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/ti-icons/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/typicons/typicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/simple-line-icons/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/css/vendor.bundle.base.css') }}" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('adminlte/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }} " />
    <link rel="stylesheet" href="{{ asset('adminlte/js/select.dataTables.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/vertical-layout-light/style.css') }}" />
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('adminlte/images/favicon.png') }}" />
</head>

<body>
    {{-- @if (request()->user()->role == 1)  --}}
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start"
                style="background: #e9e9e9;">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{route('admin.dashboard')}}">
                        <img src="{{ asset('adminlte/images/logo.svg') }}" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}">
                        <img src="{{ asset('adminlte/images/logo-mini.svg') }}" alt="logo" />
                    </a>
                </div>
            </div>

            @if(auth()->check())
            @if (isset($profileAdmin))
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">
                            Good Morning,
                            <span class="text-black fw-bold">{{$profileAdmin->name}}</span>
                        </h1>
                        <h3 class="welcome-sub-text">
                            Chào mừng bạn đến với trang ADMIN
                        </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="search-form" action="{{ route('admin.search') }}">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here"
                                name="search" />
                        </form>
                    </li>
                    <li class="nav-item dropdown" style="position: relative" onclick="message()">
                        <p style="font-weight: 900;color: red ;position: absolute;padding: 17px 0 0 20px">{{$unreadMessages->count()}}</p>
                        <a  class="nav-link count-indicator" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown"  >
                            <i class="icon-mail icon-lg"></i>
                        </a>
                        
                    </li>
                    <div id="message" style="background: #f8f6f6;border: 1px solid; padding: 30px;top: 80px;right: 100px ;position: absolute;display: none" >
                        <h1 style="font-size: 20px; padding-bottom: 10px">Tin nhắn </h1>
                        <div >
                            @foreach ($message as $data)
                            <h4>{{$data->name}}</h4>
                            <p style="  white-space: nowrap;width: 250px;overflow: hidden;text-overflow: ellipsis;">{{$data->message}}</p>
                            @endforeach
                        </div>
                       
                    </div>
                  

                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset($profileAdmin->avatar) }}" alt="Profile image" style="object-fit: cover" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ asset($profileAdmin->avatar) }}" alt="Profile image" style="object-fit: cover;width: 60px;height: 60px;"/>
                                <p class="mb-1 mt-3 font-weight-semibold">{{$profileAdmin->name}}</p>
                                <p class="fw-light text-muted mb-0">{{$profileAdmin->email}}</p>
                            </div>
                            <a class="dropdown-item" href="{{route('auth.profile')}}"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>
                                My Profile
                                <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                Messages</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                Activity</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                FAQ</a>
                            <a class="dropdown-item" href="{{route('admin.logout')}}"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
            @endif
        @endif
            @if(auth()->check())
            @if (isset($admin))
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">
                            Good Morning,
                            <span class="text-black fw-bold">{{$admin->name}}</span>
                        </h1>
                        <h3 class="welcome-sub-text">
                            Chào mừng bạn đến với trang ADMIN
                        </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="search-form" action="{{ route('admin.search') }}">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here"
                                name="search" />
                        </form>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="icon-mail icon-lg"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{$admin->avatar}}" alt="Profile image" style="object-fit: cover" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{$admin->avatar}}" alt="Profile image" style="object-fit: cover;width: 60px;height: 60px;"/>
                                <p class="mb-1 mt-3 font-weight-semibold">{{$admin->name}}</p>
                                <p class="fw-light text-muted mb-0">{{$admin->email}}</p>
                            </div>
                            <a class="dropdown-item" href="{{route('auth.profile')}}"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>
                                My Profile
                                <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                Messages</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                Activity</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                FAQ</a>
                            <a class="dropdown-item" href="{{route('admin.logout')}}"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
            @endif
        @endif
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>
                        Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>
                        Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #e9e9e9;">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    {{-- navbar Song --}}
                    {{-- <li class="nav-item nav-category">Song</li> --}}
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="menu-icon fa-solid fa-music"></i>
                            <span class="menu-title">Song</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.list.song') }}">List Song</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.check.upload') }}">Duyệt bài hát</a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.create.song') }}">Create Song</a></li>
                                        @if (request()->user()->role == 2)
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.search.song') }}">Edit Song</a></li>
                                        @endif

                            </ul>
                        </div>
                    </li>
                    {{-- navbar singer --}}
                    {{-- <li class="nav-item nav-category">Singer</li> --}}
                    <li class="nav-item">
                        <i class=""></i>
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <i class="menu-icon fa-sharp fa-solid fa-guitar"></i>
                            <span class="menu-title">Singer</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.singerSong') }}">Singer Song</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.create.singer') }}">Create Singer</a></li>
                                        @if (request()->user()->role == 2)
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.list.singer') }}">Edit Singer</a></li>
                                        @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                            aria-controls="charts">
                            <i class="menu-icon fa-sharp fa-solid fa-headphones"></i>
                            <span class="menu-title">Album</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="../../pages/charts/chartjs.html">ChartJs</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="menu-icon fa-solid fa-list"></i>
                            <span class="menu-title">Playlist</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="../../pages/tables/basic-table.html">Basic table</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">Account manager</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.account.management') }}">
                                    Account user </a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        @section('main-content')

                        @show
                    </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer"></footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    {{-- @endif --}}

    <!-- container-scroller -->

    <!-- plugins:js -->
    <script>
        var clicks = 0;
        function message(){
         clicks += 1;
         if (clicks%2 !== 0 ) {
            document.querySelector('#message').style.display = 'block' 
         }
         if (clicks%2 == 0) {
            document.querySelector('#message').style.display = 'none' 
         }
        }
    </script>
    <script src="{{ asset('adminlte/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('adminlte/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('adminlte/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('adminlte/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('adminlte/js/off-canvas.js') }}"></script>
    <script src="{{ asset('adminlte/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('adminlte/js/template.js') }}"></script>
    <script src="{{ asset('adminlte/js/settings.js') }}"></script>
    <script src="{{ asset('adminlte/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('adminlte/js/jquery.cookie.js" type="text/javascript') }}"></script>
    <script src="{{ asset('adminlte/js/dashboard.js') }}"></script>
    <script src="{{ asset('adminlte/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->
</body>

</html>
