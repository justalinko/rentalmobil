@extends('layouts.general')

@section('content')

        <!-- list mobil -->
        <section class="ftco-section bg-light pt-5">
            <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <div class="embed-responsive embed-responsive-21by9" style="height: 500px;">
                          <iframe class="embed-responsive-item" src="{{$contact->gmaps_url}}" width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                  </div>
                  <div class="col-md-6">
                      <h5 class="font-weight-bold">{{__('contact')}}</h5>
                      <p class="text-dark">{{__('Please call or come directly to our address:')}}</p>
                      <p class="text-dark"><i class="fa-solid fa-location-dot text-danger mr-1"></i> {{$contact->address}}</p>
                      <p class="text-dark"><i class="fa-regular fa-envelope text-danger mr-1"></i> {{$contact->email}}</p>
                      <p class="text-dark"><i class="fa-solid fa-phone text-danger me-1"></i> {{$contact->phone}}</p>
                      <p class="text-dark"><i class="fa-solid fa-fax text-danger mr-1"></i> {{$contact->office_phone}}</p>
                      <!-- media sosial -->
                      <div class="d-flex">
                          <a href="{{$contact->fb_url}}" >
                              <h4>
                                  <i class="fa-brands fa-square-facebook text-danger mr-2"></i>
                              </h4>
                          </a>
                          <a href="{{$contact->ig_url}}">
                              <h4>
                                <i class="fa-brands fa-instagram text-danger mr-2"></i>
                            </h4>
                          </a>
                          <a href="{{$contact->tiktok_url}}">
                              <h4>
                                <i class="fa-brands fa-tiktok text-danger mr-2"></i>
                            </h4>
                          </a>
                      </div>
                  </div>
              </div>
            </div>
        </section>
          <!-- end list mobil -->

@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('assets/js/google-map.js')}}"></script>
@endsection
