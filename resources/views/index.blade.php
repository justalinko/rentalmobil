<!DOCTYPE html>
<html lang="en">

<head>
    @if(web()?->title)
    <title>{{web()->title}}</title>
    @else
    <title>{{env('APP_NAME')}}</title>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="{{web()->meta_author}}">
    <meta name="description" content="{{web()->meta_description}}">
    <meta name="keywords" content="{{web()->meta_keywords}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

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
</head>

<body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light text-reor" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">{!!web_name()!!}</a>
            <button class="navbar-toggler float-end" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{url('/')}}" class="nav-link">{{__('home')}}</a></li>
                    {{-- <li class="nav-item"><a href="{{url('/about')}}" class="nav-link">{{__('about')}}</a></li>
                    <li class="nav-item"><a href="{{url('/terms')}}" class="nav-link">{{__('terms')}}</a></li>
                    <li class="nav-item"><a href="{{url('/privacy-policy')}}" class="nav-link">{{__('privacy_policy')}}</a></li> --}}
                    <li class="nav-item"><a href="{{url('/booking-check')}}" class="nav-link">{{__('Booking Check')}}</a></li>
                    <li class="nav-item"><a href="{{url('/vehicles')}}" class="nav-link">{{__('vehicles')}}</a></li>
                    <li class="nav-item"><a href="{{url('/contact')}}" class="nav-link">{{__('contact')}}</a></li>
                </ul>
            </div>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{App::getLocale()}}
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
    <!-- banner -->
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('/assets/images/grand_livina.png');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text w-100 text-center mb-md-5 pb-md-5">
                        <h1 class="mb-4">{{__('Fast & Easy Way To Rent A Car')}}</h1>
                        {{-- <p style="font-size: 18px;">A small river named Duden flows by their place and supplies it with
                            the necessary regelialia. It is a paradisematic country, in which roasted parts</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end banner -->
    <!-- pemesanan -->
    <section class="ftco-section ftco-no-pt bg-light pb-0">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center">
                            <form action="/direct-booking"  method="POST" class="request-form ftco-animate" style="background-color: #DF3B35;">
                                @csrf
                                <h2>{{__('Make your trip')}}</h2>
                                <div class="form-group">
                                    <label for="" class="label">{{__('pickup_location')}}</label>
                                   <div class="d-flex">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="pickup_type" value="office" id="office"  onchange="showDropOff('pickup_address','hide')" class="custom-control-input">
                                        <label class="custom-control-label label" for="office">{{__('office')}}</label>
                                      </div>
                                      <div class="ml-2 custom-control custom-radio">
                                        <input type="radio" id="other" name="pickup_type" value="other_location"  onchange="showDropOff('pickup_address','show')"   class="custom-control-input">
                                        <label class="custom-control-label label" for="other">{{__('other location')}}</label>
                                      </div>
                                   </div>
                                   <input type="text" class="form-control" style="display:none" id="pickup_address" name="pickup_address" placeholder="{{__('pickup_location')}} {{__('other location')}}"> 
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">{{__('drop_off location')}}</label>
                                    <div class="d-flex">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="dropoff_type" value="office" onchange="showDropOff('dropoff_address','hide')" id="officeDropoff"  class="custom-control-input">
                                            <label class="custom-control-label label" for="officeDropoff">{{__('office')}}</label>
                                          </div>
                                          <div class="ml-2 custom-control custom-radio">
                                            <input type="radio" id="otherDropoff" value="other_location" onchange="showDropOff('dropoff_address','show')" name="dropoff_type"  class="custom-control-input">
                                            <label class="custom-control-label label" for="otherDropoff">{{__('other location')}}</label>
                                          </div>
                                    </div>
                                   <input type="text" class="form-control" id="dropoff_address" style="display:none" name="dropoff_address" placeholder="{{__('drop_off location')}} {{__('other location')}}"> 
                                </div>
                                <div class="d-flex">
                                    <div class="form-group mr-2">
                                        <label for="" class="label">{{__('pick-up date')}}</label>
                                        <input type="text" name="pickup_date" class="form-control" id="book_pick_date" placeholder="Date">
                                    </div>
                                    <div class="form-group ml-2">
                                        <label for="" class="label">{{__('drop-off date')}}</label>
                                        <input type="text" name="dropoff_date" class="form-control" id="book_off_date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">{{__('pick-up time')}}</label>
                                    <input type="text" name="pickup_time" class="form-control" id="time_pick" placeholder="Time">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-light bg-light text-dark py-3 px-4">{{__('Rent A Car Now')}}</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">{{__('Better Way to Rent Your Perfect Cars')}}</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-route text-danger"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">{{__('Choose Your Pickup Location')}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-handshake text-danger"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">{{__('Select the Best Deal')}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-rent text-danger"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">{{__('Reserve Your Rental Car')}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="/vehicles" class="btn btn-danger py-3 px-4">{{__('Reserve your perfect car')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- end pemesanan -->

    <!-- list mobil -->
    <section class="ftco-section bg-light pt-5">
        <div class="container">
            <div class="d-flex justify-content-between mb-1">
                <h5 class="font-weight-bold"><i class="flaticon-car text-danger"></i> {{__('Best Selling Rental Car')}}</h5>
                <a href="{{url('/vehicles')}}" class="text-danger">{{__('view car')}} <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="row">

                @foreach($armadas as $ar)
                <div class="col-md-4">
                    <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end"
                            style="background-image: url('{{$ar->thumbnail}}');">
                        </div>
                        <div class="text p-3">
                            <h2 class="mb-0"><a href="/detail/{{$ar->id}}">{{$ar->name}}</a></h2>
                            <div class="d-flex mb-3">
                                <span class="cat">{{$ar->brand}}</span>
                            </div>
                            <div class="align-content-center badge-light p-3 mb-2">
                                <div class="d-flex justify-content-between">
                                    <p><i class="flaticon-car-seat text-danger m-0"></i> {{$ar->seat}} {{__('seat')}}</p>
                                    <p><i class="flaticon-backpack text-danger"></i> {{$ar->luggage}} {{__('luggage')}}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="m-0"><i class="flaticon-pistons text-danger"></i>&nbsp;{{$ar->transmission}}</p>
                                    <p class="m-0"><i class="flaticon-diesel text-danger"></i> {{$ar->fuel}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="text-danger ml-auto">{{rupiah($ar->price_hour)}} <span>/{{__('hour')}}</span></p>
                                <p class="text-danger ml-auto">{{rupiah($ar->price_day)}} <span>/{{__('day')}}</span></p>
                            </div>
                            <p class="d-flex mb-0 d-block">
                                <a href="/book/{{$ar->id}}" class="btn btn-outline-danger py-2 mr-1">{{__('Book Now')}}</a>
                                <a href="/detail/{{$ar->id}}" class="btn btn-secondary py-2 ml-1">{{__('details')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                       {{$armadas->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end list mobil -->

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="{{url('/')}}" class="logo">{{web()->name}}</a></h2>
                        <p>{{substr(web()->about,0,100)}} ... <a href="/about">More</a></p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="{{web()->fb_url}}"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="{{web()->ig_url}}"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Information</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{url('/about')}}" class="py-2 d-block">{{__('about')}}</a></li>
                            <li><a href="{{url('/terms')}}" class="py-2 d-block">{{__('terms')}}</a></li>
                            <li><a href="{{url('/privacy-policy')}}" class="py-2 d-block">{{__('privacy_policy')}}</a></li>
    
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">{{__('Have a Questions?')}}</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">{{web()->address}}</span></li>
                                <li><a href="tel:{{web()->phone}}"><span class="icon icon-phone"></span><span class="text">{{web()->phone}}</span></a></li>
                                <li><a href="mailto:{{web()->email}}"><span class="icon icon-envelope"></span><span
                                            class="text">{{web()->email}}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
    
    
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->


    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/aos.js')}}"></script>
    <script src="{{asset('assets/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/scrollax.min.js')}}"></script>
   <script >
    function showDropOff(id, type)
    {
        if(type == 'show'){
        document.getElementById(id).style.display='block';
        }else{
        document.getElementById(id).style.display='none';
        }
    }
   </script>
    <script src="{{asset('assets/js/google-map.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/7ac3fca741.js')}}" crossorigin="anonymous"></script>
</body>

</html>
