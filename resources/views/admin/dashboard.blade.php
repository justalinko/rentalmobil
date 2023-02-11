@extends('admin.layouts.general')

@section('content')

    <h2> Dashboard</h2>

    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
        <div class="inner">
            <div class="app-card-body p-3 p-lg-4">
                <h3 class="mb-3">Welcome, {{auth()->user()->name}}!</h3>
                <div class="row gx-5 gy-3">
                    <div class="col-12 col-lg-9">
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!--//app-card-body-->

        </div>
        <!--//inner-->
    </div>

    {{-- card overview --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Rental</h4>
                    <div class="stats-figure">{{$totalRental}}</div>
                    <div class="stats-meta text-success">All time</div>
                </div>
                <!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
        </div>
        <!--//col-->

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Income</h4>
                    <div class="stats-figure">{{rupiah($totalIncome)}}</div>
                    <div class="stats-meta text-success">
                        All Time
                    </div>
                </div>
                <!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
        </div>
        <!--//col-->
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Rent in a week</h4>
                    <div class="stats-figure">{{$totalRentalWeek}}</div>
                    <div class="stats-meta">Total rental in week</div>
                </div>
                <!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
        </div>
        <!--//col-->
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Income a week</h4>
                    <div class="stats-figure">{{rupiah($totalIncomeWeek)}}</div>
                    <div class="stats-meta">total income in week</div>
                </div>
                <!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
        </div>
        <!--//col-->
    </div>
    <!--//row-->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Recent Rental
                    </h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Booking ID</th>
                            <th>Status</th>
                            <th>User Detail</th>
                            <th>Rental Item</th>
                            <th>Duration</th>
                            <th>Payment Method</th>
                            <th>Price</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->booking_code}}</td>
                                <td>{!!invoiceStatus($order->status)!!}</td>
                                <td>
                                    <span class="badge bg-primary"><i class="fa fa-user"></i> {{$order->name}}</span>
                                    <span class="badge bg-info"><i class="fa fa-envelope"></i> {{$order->email}}</span>
                                    <span class="badge bg-danger"><i class="fa fa-phone"></i> {{$order->phone}}</span>
                                </td>
                                <td>
                                    <b >{{$order->armada->brand}} {{$order->armada->name}} ( {{$order->armada->transmission}} )</b>
                                </td>
                                <td>
                                    <span class="badge bg-success"><i class="fa fa-calendar"></i> {{$order->start_date}} ( {{$order->start_time}} )</span>
                                    <span class="badge bg-danger"><i class="fa fa-calendar"></i> {{$order->end_date}} ( {{$order->end_time}} )</span>
                                    <span class="badge bg-info"><i class="fa fa-refresh"></i> {{dooration($order->start_date,$order->end_date,$order->start_time,$order->end_time)}}</span>
                                </td>
                                <td>{{$order->payment_method}}</td>
                                <td>{{rupiah($order->total_price)}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                   
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            @php
                                                $peler =  ['waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' , 'cancelled' , 'finished'];
                                            @endphp
                                            <li><a class="dropdown-item" href="/i/{{$order->booking_code}}">View</a></li>
                                            @foreach ($peler as $ax)
                                                <li><a class="dropdown-item"  href="/order/{{$order->id}}/status?to={{$ax}}">{{strtoupper(str_replace('_',' ',$ax))}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
