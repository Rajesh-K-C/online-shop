<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('assets/images/setting/' . $setting->favicon)}}" type="image/x-icon">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{route('backend.dashboard')}}">
                <div class="sidebar-brand-icon">
                <img style="height: 3.5rem" src="{{asset('assets/images/setting/' . $setting->logo)}}" alt="">
                </div>
                <div class="sidebar-brand-text">
                    {{$setting->website_name}}
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('backend.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('index')}}">
                    <i class="far fa-window-maximize"></i>
                    <span>View website</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Setup
            </div>

            @if(Auth::user()->hasRole('admin'))
                <!-- Nav Item - Permission Collapse Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePermission"
                        aria-expanded="true" aria-controls="collapsePermission">

                        <span>Permission</span>
                    </a>
                    <div id="collapsePermission" class="collapse" aria-labelledby="headingPermission"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6>--}}
                            <a class="collapse-item" href="{{ route('backend.permission.create') }}">Create</a>
                            <a class="collapse-item" href="{{ route('backend.permission.index') }}">List</a>
                        </div>
                    </div>
                </li> -->
                <!-- Nav Item - Role Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRole"
                        aria-expanded="true" aria-controls="collapseRole">
                        <i class="fas fa-user"></i>
                        <span>Role</span>
                    </a>
                    <div id="collapseRole" class="collapse" aria-labelledby="headingRole" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('backend.role.create') }}">Create</a>
                            <a class="collapse-item" href="{{ route('backend.role.index') }}">List</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Users -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('backend.user.index')}}">
                        <svg style="width: 20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#FFFFFF4D"
                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                        </svg>
                        <span>Users</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->hasPermissionTo('manage-setting'))
                <!-- Nav Item - Settings Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
                        aria-expanded="true" aria-controls="collapseSettings">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Setting</span>
                    </a>
                    <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Utilities:</h6>--}}
                            <a class="collapse-item" href="{{route('backend.setting.create')}}">Create</a>
                            <a class="collapse-item" href="{{ route('backend.setting.index') }}">List</a>
                        </div>
                    </div>
                </li>
            @endif

            @if (Auth::user()->hasPermissionTo('manage-location'))
                <!-- Nav Item - Location Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocation"
                        aria-expanded="true" aria-controls="collapseLocation">
                        <i class="fas fa-map-marker"></i>
                        <span>Location</span>
                    </a>
                    <div id="collapseLocation" class="collapse" aria-labelledby="headingLocation"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('backend.state.create') }}">State Create</a>
                            <a class="collapse-item" href="{{ route('backend.state.index') }}">State List</a>
                            <a class="collapse-item" href="{{ route('backend.district.create') }}">District Create</a>
                            <a class="collapse-item" href="{{ route('backend.district.index') }}">District List</a>
                            <a class="collapse-item" href="{{ route('backend.city.create') }}">City Create</a>
                            <a class="collapse-item" href="{{ route('backend.city.index') }}">City List</a>
                        </div>
                    </div>
                </li>
            @endif

            @if (Auth::user()->hasPermissionTo('manage-category'))
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">

                        <span>Category</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6>--}}
                            <a class="collapse-item" href="{{ route('backend.category.create') }}">Create</a>
                            <a class="collapse-item" href="{{ route('backend.category.index') }}">List</a>
                        </div>
                    </div>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Operation
            </div>

            @if(Auth::user()->hasPermissionTo('manage-product'))
                <!-- Nav Item - Product Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                        aria-expanded="true" aria-controls="collapseProduct">

                        <span>Product</span>
                    </a>
                    <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{route('backend.product.create')}}">Create</a>
                            <a class="collapse-item" href="{{route('backend.product.index')}}">List</a>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth::user()->hasPermissionTo('update-order-status'))
                <!-- Nav Item - Users -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('backend.order.index')}}">

                        <span>Orders</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasPermissionTo('manage-contact'))
                <!-- Nav Item - Users -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('backend.contact.index')}}">
                        <i class="far fa-address-book"></i>
                        <span>Contact Us</span>
                    </a>
                </li>
            @endif
            {{-- <!-- Nav Item - Pages Collapse Menu -->--}}
            {{-- <li class="nav-item active">--}}
                {{-- <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" --}} {{-- aria-controls="collapsePages">--}}
                    {{-- <i class="fas fa-fw fa-folder"></i>--}}
                    {{-- <span>Pages</span>--}}
                    {{-- </a>--}}
                {{-- <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" --}} {{--
                    data-parent="#accordionSidebar">--}}
                    {{-- <div class="bg-white py-2 collapse-inner rounded">--}}
                        {{-- <h6 class="collapse-header">Login Screens:</h6>--}}
                        {{-- <div class="collapse-divider"></div>--}}
                        {{-- <h6 class="collapse-header">Other Pages:</h6>--}}
                        {{-- <a class="collapse-item" href="#">404 Page</a>--}}
                        {{-- <a class="collapse-item active" href="#">Blank Page</a>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- </li>--}}

            {{-- <!-- Nav Item - Charts -->--}}
            {{-- <li class="nav-item">--}}
                {{-- <a class="nav-link" href="#">--}}
                    {{-- <i class="fas fa-fw fa-chart-area"></i>--}}
                    {{-- <span>Charts</span></a>--}}
                {{-- </li>--}}

            {{-- <!-- Nav Item - Tables -->--}}
            {{-- <li class="nav-item">--}}
                {{-- <a class="nav-link" href="#">--}}
                    {{-- <i class="fas fa-fw fa-table"></i>--}}
                    {{-- <span>Tables</span></a>--}}
                {{-- </li>--}}

            {{-- <!-- Divider -->--}}
            {{--
            <hr class="sidebar-divider d-none d-md-block">--}}

            {{-- <!-- Sidebar Toggler (Sidebar) -->--}}
            {{-- <div class="text-center d-none d-md-inline">--}}
                {{-- <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
                {{-- </div>--}}

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    {{-- <!-- Topbar Search -->--}}
                    {{-- <form--}} {{--
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">--}}
                        {{-- <div class="input-group">--}}
                            {{-- <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." --}} {{-- aria-label="Search"
                                aria-describedby="basic-addon2">--}}
                            {{-- <div class="input-group-append">--}}
                                {{-- <button class="btn btn-primary" type="button">--}}
                                    {{-- <i class="fas fa-search fa-sm"></i>--}}
                                    {{-- </button>--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- </form>--}}

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            {{-- <!-- Nav Item - Search Dropdown (Visible Only XS) -->--}}
                            {{-- <li class="nav-item dropdown no-arrow d-sm-none">--}}
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" --}}
                                    {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                    {{-- <i class="fas fa-search fa-fw"></i>--}}
                                    {{-- </a>--}}
                                {{-- <!-- Dropdown - Messages -->--}}
                                {{-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" --}}
                                    {{-- aria-labelledby="searchDropdown">--}}
                                    {{-- <form class="form-inline mr-auto w-100 navbar-search">--}}
                                        {{-- <div class="input-group">--}}
                                            {{-- <input type="text" class="form-control bg-light border-0 small" --}}
                                                {{-- placeholder="Search for..." aria-label="Search" --}} {{--
                                                aria-describedby="basic-addon2">--}}
                                            {{-- <div class="input-group-append">--}}
                                                {{-- <button class="btn btn-primary" type="button">--}}
                                                    {{-- <i class="fas fa-search fa-sm"></i>--}}
                                                    {{-- </button>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- </form>--}}
                                    {{-- </div>--}}
                                {{-- </li>--}}

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- <i class="fas fa-envelope fa-fw"></i> -->
                                    <!-- Counter - Messages -->
                                    <!-- <span class="badge badge-danger badge-counter">7</span> -->
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="{{asset('assets/backend/img/undraw_profile_1.svg')}}" alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with
                                                a
                                                problem I've been having.
                                            </div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="{{asset('assets/backend/img/undraw_profile_2.svg')}}" alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month,
                                                how
                                                would you like them sent to you?
                                            </div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="{{asset('assets/backend/img/undraw_profile_3.svg')}}" alt="...">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy
                                                with
                                                the progress so far, keep up the good work!
                                            </div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    {{-- <a class="dropdown-item d-flex align-items-center" href="#">--}}
                                        {{-- <div class="dropdown-list-image mr-3">--}}
                                            {{-- <img class="rounded-circle"
                                                src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" --}} {{--
                                                alt="...">--}}
                                            {{-- <div class="status-indicator bg-success"></div>--}}
                                            {{-- </div>--}}
                                        {{-- <div>--}}
                                            {{-- <div class="text-truncate">Am I a good boy? The reason I ask is because
                                                someone--}}
                                                {{-- told me that people say this to all dogs, even if they aren't
                                                good...</div>--}}
                                            {{-- <div class="small text-gray-500">Chicken the Dog · 2w</div>--}}
                                            {{-- </div>--}}
                                        {{-- </a>--}}
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                        Messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{asset('assets/backend/img/undraw_profile.svg')}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <!-- <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website {{date('Y')}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/backend/js/sb-admin-2.min.js')}}"></script>
    @yield('js')
</body>

</html>