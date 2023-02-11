@extends('layouts.general')

@section('content')

<!-- start rule -->
<section class="ftco-section bg-light pt-5">
    <div class="container">
        <div class="card">
            <div class="card-body">
                {!!$terms!!}
            </div>
        </div>
    </div>
  </section>
  <!-- end terms -->

@endsection
