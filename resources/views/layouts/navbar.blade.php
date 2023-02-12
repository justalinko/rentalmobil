<!DOCTYPE html>
<html lang="en">
  <head>
    @if (\App\Models\Websetting::all()[0]?->title)

    <title> {{\App\Models\Websetting::all()[0]?->title}}</title>

    @else
      <title> {{env('APP_NAME')}} </title>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="{{web()->meta_author}}">
    <meta name="description" content="{{web()->meta_description}}">
    <meta name="keywords" content="{{web()->meta_keywords}}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- costum css -->
    <link rel="stylesheet" href="{{asset('assets/css/css/custom.css')}}">
    @yield('css')
  </head>
  <body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-white sticky-top" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{url('/')}}">{!!web_name()!!}</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item @if (Request::is('/')) active @endif "><a href="{{url('/')}}" class="nav-link">{{__('home')}}</a></li>
              <li class="nav-item @if (Request::is('booking-check')) active @endif"><a href="{{url('booking-check')}}" class="nav-link">{{__('Booking Check')}}</a></li>
	          <li class="nav-item @if (Request::is('vehicles')) active @endif"><a href="{{url('vehicles')}}" class="nav-link">{{__('vehicles')}}</a></li>
	          <li class="nav-item @if (Request::is('contact')) active @endif"><a href="{{url('contact')}}" class="nav-link">{{__('contact')}}</a></li>
	        </ul>
	      </div>
          <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fa fa-language"></i> {{strtoupper(App::getLocale())}}
                </button>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="btnGroupDrop1">
                <li>
                    <a class="dropdown-item" href="/lang/id">
                    <img src="{{asset('assets/flag/id.png')}}" class="img-fluid" style="max-width: 25px; max-height: 25px;" alt="">&NonBreakingSpace; id_ID
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/lang/en">
                    <img src="{{asset('assets/flag/us.png')}}" class="img-fluid" style="max-width: 25px; max-height: 25px;" alt="">&NonBreakingSpace; en_US
                    </a>
                </li>
                </div>
            </div>
	    </div>
	  </nav>
    <!-- END nav -->
