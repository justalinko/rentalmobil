@extends('layouts.general')


@section('content')

    	<!-- list mobil -->
        <section class="ftco-section bg-light pt-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="font-weight-bold"><i class="flaticon-car"></i> {{__('list car')}}</h5>
                    <!-- filter display smartphone -->
                    <button type="button" class="btn btn-outline-danger d-lg-none d-md-none" data-toggle="modal" data-target="#exampleModal">
                        <i class="flaticon-car"></i> Filter
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-3 d-lg-block d-none">
                        <div class="card shadow-sm border-0">
                            <div class="card-header pb-0">
                                <h5 class="font-weight-bold">Filter</h5>
                            </div>
                            <div class="card-body">
                                <!-- isi penumpang -->
                                <label for="type" class="label mb-0"><i class="flaticon-list text-danger"></i> {{__('type')}}</label>
                                <div class="input-group mb-3">
                                    <select name="type" id="tipe" class="custom-select" onchange="tipeFilter()">
                                        <option value="all" @if(Request::get('t') == 'all') selected @endif >{{__('all')}}</option>
                                        <option value="car" @if(Request::get('t') == 'car') selected @endif>{{__('car')}}</option>
                                        <option value="motorcycle" @if(Request::get('t') == 'motorcycle') selected @endif>{{__('motorcycle')}}</option>
                                    </select>
                                </div>
                                    <form method="get" action="/vehicles" id="filterForm" @if(Request::get('t') !== 'car') style="display:none;" @endif>
                                        <input type="hidden" name="t" value="{{Request::get('t')}}">
                                    <label class="label mb-0" for="inputGroupSelect01"><i class="flaticon-car-seat text-danger"></i> {{__('seat')}}</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" name="seat" id="inputGroupSelect01">
                                          <option value="">{{__('choose')}} {{__('seat')}}</option>
                                          <option value="5" @if(Request::get('seat') == 5) selected @endif>5 {{__('seat')}}</option>
                                          <option value="8" @if(Request::get('seat') == 8 ) selected @endif)>8 {{__('seat')}}</option>
                                          <option value="11" @if(Request::get('seat') == 11 ) selected @endif>11 {{__('seat')}}</option>
                                        </select>
                                    </div>
                                    <!-- Jenis Mobil -->
                                    <label class="label mb-0" for="inputGroupSelect01"><i class="flaticon-car text-danger"></i> {{__('type car')}}</label>
                                    <div class="input-group mb-3 border-0">
                                        <select class="custom-select" name="transmission" id="inputGroupSelect01">
                                          <option value="" >{{__('choose')}} {{__('car')}}</option>
                                          <option value="automatic" @if(Request::get('transmission') == 'automatic') selected @endif>Automatic</option>
                                          <option value="manual" @if(Request::get('transmission') == 'manual') selected @endif>Manual</option>
                                        </select>
                                    </div>
                                    <!-- Jenis Bahan Bakar -->
                                    <label class="label mb-0" for="inputGroupSelect01"><i class="flaticon-diesel text-danger"></i> {{__('fuel')}}</label>
                                    <div class="input-group mb-3 border-0">
                                        <select class="custom-select" name="fuel" id="inputGroupSelect01">
                                        <option value="">{{__('choose')}} {{__('fuel')}}</option>
                                          <option value="petrol" @if(Request::get('fuel') == 'petrol') selected @endif>{{__('petrol')}}</option>
                                          <option value="diesel" @if(Request::get('fuel') == 'diesel') selected @endif>{{__('diesel')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group mt-1">
                                       
                                        <input type="submit" class="btn btn-secondary w-100" value="{{__('Search')}}">
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <!-- search -->
                        <div class="card shadow-sm" style="border-radius: 10px;">
                            <div class="card-body">
                               <form action="/vehicles" method="get">
                                <input type="text" class="form-control" placeholder="{{__('Search')}}..." name="search" ondragenter="this.form.submit()" onchange="this.form.submit()">
                                </form>
                            </div>
                        </div>
                        <!-- list mobil -->
                        <div class="row">
                            @foreach($armadas as $ar)
                            <div class="col-md-6 mt-3">
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
                                                <p><i class="flaticon-car-seat text-danger m-0"></i> {{$ar->seat}} Seats</p>
                                                <p><i class="flaticon-backpack text-danger"></i> {{$ar->luggage}} luggage</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="m-0"><i class="flaticon-pistons text-danger"></i>&nbsp;{{$ar->transmission}}</p>
                                                <p class="m-0"><i class="flaticon-diesel text-danger"></i> {{$ar->fuel}}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <p class="text-mute">Start From</p>
                                            {{-- <p class="text-danger ml-auto">{{rupiah($ar->price_hour)}} <span>/hour</span></p> --}}
                                            <p class="text-danger ml-auto">{{rupiah($ar->price_day)}} <span>/day</span></p>
                                        </div>
                                        <p class="d-flex mb-0 d-block"><a href="/book/{{$ar->id}}"
                                                class="btn btn-outline-danger py-2 mr-1">Book now</a>
                                                <a href="/detail/{{$ar->id}}" class="btn btn-secondary py-2 ml-1">Details</a></p>
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
                </div>
            </div>
        </section>
        <!-- end list mobil -->
        <!-- Modal filter smartphone-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <label class="label mb-0" for="inputGroupSelect01"><i class="flaticon-car-seat text-danger"></i> {{__('seat')}}</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01">
                          <option selected>Choose Seats</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                    </div>
                    <!-- Jenis Mobil -->
                    <label class="label mb-0" for="inputGroupSelect01"><i class="flaticon-car text-danger"></i> {{__('type car')}}</label>
                    <div class="input-group mb-3 border-0">
                        <select class="custom-select" id="inputGroupSelect01">
                          <option selected>Choose Car</option>
                          <option value="1">Auto Matic</option>
                          <option value="2">Manual</option>
                        </select>
                    </div>
                    <!-- Jenis Bahan Bakar -->
                    <label class="label mb-0" for="inputGroupSelect01"><i class="flaticon-diesel text-danger"></i> {{__('fuel')}}</label>
                    <div class="input-group mb-3 border-0">
                        <select class="custom-select" id="inputGroupSelect01">
                          <option selected>Choose Car</option>
                          <option value="1">Auto Matic</option>
                          <option value="2">Manual</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger">Search</button>
                </div>
              </div>
            </div>
        </div>
        <!-- end modal -->

@endsection
@section('js')
<script>
    function tipeFilter(){
        const tipe = document.getElementById('tipe').value;
        const filterForm = document.getElementById('filterForm')
        if(tipe == 'car')
        {
            filterForm.style.display='block';
        }else{
            filterForm.style.display='none';
        }
        window.location.href = '?t='+ tipe;
    }
</script>
@endsection