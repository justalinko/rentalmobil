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
                <div class="col-auto">
                    <a class="btn app-btn-secondary" href="/admin/orders/add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                        New Order
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

    @php $allStatus = ['all','waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' , 'on_going','cancelled' , 'finished']; @endphp
  
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
                        <th>Customer Type</th>
                        <th>User Detail</th>
                        <th>Contact Type</th>
                        <th>Rental Item</th>
                        <th>Duration</th>
                        <th>Payment Method</th>
                        <th>Price</th>
                        <th>Created at</th>
                        <th>Created By</th>
                        <th>Change Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-success" onclick="window.location.href='/i/{{$order->booking_code}}'" style="cursor
                            :pointer">{{$order->booking_code}}</td>
                            <td>{!!invoiceStatus($order->status)!!}</td>
                            <td>
                                @if($order->customer_type == 'user')
                                <span class="badge bg-primary"><i class="fa fa-user"></i> User</span>
                                @else
                                <span class="badge bg-info"><i class="fa fa-user"></i> Agency</span>
                                @endif
                                
                            </td>
                            <td>
                                <span class="badge bg-primary"><i class="fa fa-user"></i> {{$order->name}}</span>
                                <span class="badge bg-info"><i class="fa fa-envelope"></i> {{$order->email}}</span>
                                <span class="badge bg-danger"><i class="fa fa-phone"></i> {{$order->phone}}</span>
                            </td>
                            <td>
                                @if($order->contact_type == 'whatsapp')
                                <span class="badge bg-success"><i class="fab fa-whatsapp"></i> {{$order->contact_id}}</span>
                                @else
                                <span class="badge bg-info"><i class="fab fa-telegram"></i> {{$order->contact_id}}</span>
                                @endif
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
                            <td>{{$order->created_by}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        @php
                                            $peler =  ['waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' ,'on_going','cancelled' , 'finished'];
                                        @endphp
                                      
                                        @foreach ($peler as $ax)
                                            <li><a class="dropdown-item"  href="/admin/orders/{{$order->id}}/status?to={{$ax}}">{{strtoupper(str_replace('_',' ',$ax))}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="/admin/orders/{{$order->id}}/edit" class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i></a>
                                <a href="/i/{{$order->booking_code}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-eye"></i></a>                               
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

    <!--//app-pagination-->

</div>

@endforeach
    
</div>
<!--//tab-content-->

@endsection


@if(Request::get('add') == 'true')
@section('js')
<script>
    $(document).ready(function(){
        $('#add').modal('show');
    });
</script>
@endsection
@endif