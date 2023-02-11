@extends('layouts.general')


@section('content')

<section class="ftco-section bg-light pt-4">
    <div class="container">
       
        <div class="card border-0  mb-2">
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">

                    @foreach(json_decode($detail->images) as $image)
                    
                    <div class="tab-pane fade show @if($loop->index == 0) active @endif" id="nav{{sha1($image)}}" role="tabpanel" aria-labelledby="nav{{sha1($image)}}" style="background-image: url({{$image}}); background-size:cover;  border-radius:5px;">
                        <div style="padding: 25%">

                        </div></div>
                  @endforeach
                  </div>
                <nav>
                    <div class="nav nav-tabs border-0 mt-1" id="nav-tab" role="tablist" style="display: flex ;">
                      @foreach(json_decode($detail->images) as $image)
                      <a class="nav-item nav-link" id="navTab{{sha1($image)}}" data-toggle="tab" href="#nav{{sha1($image)}}" role="tab" aria-controls="nav-profile" aria-selected="false" style="background-image: url({{$image}}); background-size:cover;  border-radius:5px;  max-widht:10px; max-height:60px;">
                        <div class="p-5">

                        </div></a>

                        @endforeach
                    </div>
                </nav>
            </div>
        </div>
            {{-- spesifikasi harga--}}
        <div class="card border-0  mb-2">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-0 d-block">
                    <h3 class="font-weight-bold">{{$detail->brand}} - {{$detail->name}}</h3>
                    <p>
                        <a href="/book/{{$detail->id}}" class="btn btn-danger pt-2"><i class="fa fa-shopping-cart"></i> {{__('Book Now')}}</a>
                    </p>
                </div>
                <p>{!!$detail->description!!}</p>
                {{-- spesifikasi harga --}}
                
            </div>
        </div>
        {{-- spesisikasi mobil --}}
        <div class="card border-0  mb-2">
            <div class="card-body">
                <h3 class="font-weight-bold">{{__('more detail about')}} {{$detail->brand}} {{$detail->name}}</h3>
               
                {{-- spesifikasi harga --}}
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered w-100">
                            <thead>
                                <tr class="text-center bg-light">
                                    <th>Name</th>
                                    <th>Spesifikasi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                
                                <tr>
                                    <td>{{__('seat')}}</td>
                                    <td>Max {{$detail->seat}} {{__('seat')}}</td>
                                </tr>
                                <tr>
                                    <td>Audio System</td>
                                    <td><font color=green>YES</font></td>
                                </tr>
                                <tr>
                                    <td>Bluetooth</td>
                                    <td><font color=green>YES</font></td>
                                </tr>
                                <tr>
                                    <td>{{__('fuel')}}</td>
                                    <td>{{__($detail->fuel)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Luggage')}}</td>
                                    <td>Max {{$detail->luggage}} {{__('item')}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- spesifikasi --}}


</section>

@endsection

