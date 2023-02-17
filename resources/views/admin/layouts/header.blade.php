<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin - {{web()->title}}</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="{{web()->meta_description}}">
	<meta name="author" content="{{web()->meta_author}}">
	<link rel="shortcut icon" href="{{web()->icon}}">

	<!-- FontAwesome JS-->
	<script defer src="{{asset('assets/backend/assets/plugins/fontawesome/js/all.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="{{asset('assets/backend/assets/css/portal.css')}}">

    @yield('css')
</head>
<body class="app">

    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                    role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                       

                        <div class="app-utilities col-auto">
                           
                            

                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false"><img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}"
                                        alt="user profile" class="rounded-circle img-fluid"></a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="/admin/profile">Account</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{route('logout')}}">Log Out</a></li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        @include('admin.layouts.sidebar')
    </header>
