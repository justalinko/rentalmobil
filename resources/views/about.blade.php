@extends('layouts.general')

@section('content')

    <!-- about -->
    <section class="ftco-section bg-light pt-5">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-12 mb-3">
              <img src="https://images.unsplash.com/photo-1576267423048-15c0040fec78?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid w-100 rounded shadow-sm" alt="">
            </div>
            <div class="col-md-8 col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="">{{__('about')}}</h2>
                      {!!$about!!}
                    </div>
                </div>
            </div>
          </div>
          <!-- Visi Misi -->
        </div>
      </section>
      <!-- end about -->

@endsection
