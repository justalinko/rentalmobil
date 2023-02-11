@extends('admin.layouts.general')

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h2 class="app-page-title mb-0">Vehicles / Kendaraan</h2>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    
                    <div class="col-auto">
                        <a class="btn app-btn-secondary" href="/admin/export?d=vehicles" target="_blank">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                            Download Excel
                        </a>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//table-utilities-->
        </div>
        <!--//col-auto-->
    </div>


<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
        aria-labelledby="orders-all-tab">

        {{-- data mobil --}}
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover table-bordered mb-0 text-left datatable">
                        <thead>
                            <tr>
                                <th class="cell">Type</th>
                                <th class="cell">Brand Name</th>
                                <th class="cell">Seat</th>
                                <th class="cell">Luggage</th>
                                <th class="cell">Transmission</th>
                                <th class="cell">Fuel Type</th>
                                <th class="cell">Price/Hour</th>
                                <th class="cell">Price/Day</th>
                                <th class="cell">+ Price Other Location ( Pickup & DropOff )</th>
                                <th class="cell">+ Price With Driver</th>
                                <th class="cell">Stock</th>
                                <th class="cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($armadas as $ve)
                            <tr>
                                <td>@if($ve->type == 'car') <span class="badge bg-success">CAR</span> @else <span class="badge bg-secondary">{{$ve->type}}</span>@endif</td>
                                <td>
                                    {{$ve->brand}} {{$ve->name}}
                                </td>
                                <td>
                                    {{$ve->seat}}
                                </td>
                                <td>
                                    {{$ve->luggage}}
                                </td>
                                <td>
                                    {{$ve->transmission}}
                                </td>
                                <td>
                                    {{$ve->fuel}}
                                </td>
                                <td>
                                    {{rupiah($ve->price_hour)}}
                                </td>
                                <td>
                                    {{rupiah($ve->price_day)}}
                                </td>
                                <td>{{rupiah($ve->price_otherlocation)}}</td>
                                <td>{{rupiah($ve->price_withdriver)}}</td>
                                <td>
                                    {{$ve->stock}}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                          
                                            <li><a class="dropdown-item" href="/admin/vehicles/{{$ve->id}}/edit">Edit</a></li>
                                            <li><a class="dropdown-item" href="/admin/vehicles/{{$ve->id}}/delete">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--//table-responsive-->

            </div>
            <!--//app-card-body-->
        </div>
       

    </div>
    <!--//tab-pane-->
</div>
<!--//tab-content-->
@endsection
