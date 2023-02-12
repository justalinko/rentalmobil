<!-- end list mobil -->

<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2"><a href="{{url('/')}}" class="logo">{!!web_name()!!}</a></h2>
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
<script src="{{asset('assets/js/main.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
    
        icon: 'success',
        title : 'Success',
        text: "{{session('success')}}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title : 'Oops...',
        text: "{{session('error')}}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif

@if(session('errors'))
<script>
    Swal.fire({

        icon: 'error',
        title : 'Oops...',
        text: "{!!session('errors')!!}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif

<!-- fontawesome -->
<script src="https://kit.fontawesome.com/7ac3fca741.js" crossorigin="anonymous"></script>
@yield('js')
</body>

</html>
