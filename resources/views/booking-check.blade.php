@extends('layouts.general')

@section('content')

    <!-- list mobil -->
    <section class="ftco-section bg-light pt-5">
        <div class="container">
         <div class="card shadow-sm rounded">
          <div class="card-body">
              <h5 class="font-weight-bold">{{__('Check Status Booking')}}</h5>
                <form action="/booking-check" method="post">
                    @csrf
                    <label for="" class="font-italic text-danger mb-0">{{__('Enter your booking code in the input below')}}</label>
              <input type="text" class="form-control" placeholder="Masukkan Kode Booking...">
              <button type="submit" class="btn-lg btn btn-danger mt-2">{{__('Check Booking Code')}}</button>
                </form>
          </div>
         </div>
        </div>
      </section>
      <!-- end list mobil -->

@endsection
