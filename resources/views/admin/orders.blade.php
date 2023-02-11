@extends('admin.layouts.general')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Orders</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
               
                <div class="col-auto">
                    <a class="btn app-btn-secondary" href="/admin/export?d=order" target="_blank">
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
<!--//row-->


<nav id="orders-table-tab"
    class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">

    @php $allStatus = ['all','waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' , 'cancelled' , 'finished']; @endphp
  
        @foreach($allStatus as $sta)
    <a class="flex-sm-fill text-sm-center nav-link @if($sta == 'all') active @endif" id="{{$sta}}-tab" data-bs-toggle="tab"
        href="#{{$sta}}" role="tab" aria-controls="{{$sta}}"
        aria-selected="false">{{str_replace('_',' ',ucfirst($sta))}}</a>
        @endforeach
</nav>


<div class="tab-content" id="orders-table-tab-content">
    @foreach($allStatus as $st)
    @php 
    if($st == 'all'){
    $orders = App\Models\Order::orderBy('id','desc')->get();
    }else{
    $orders = App\Models\Order::where('status',$st)->orderBy('id','desc')->get(); 
    }
    @endphp
    <div class="tab-pane fade show @if($st == 'all') active @endif" id="{{$st}}" role="tabpanel"
    aria-labelledby="{{$st}}-tab">

    {{-- all data table --}}
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover datatable">
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
            <!--//table-responsive-->

        </div>
        <!--//app-card-body-->
    </div>
    <!--//app-card-->
    <nav class="app-pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    <!--//app-pagination-->

</div>

@endforeach
    
</div>
<!--//tab-content-->

@endsection
