@extends('admin.layouts.general')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="/admin/reports/filter" method="get" class="row">
                    <div class="form-group col-md-4">
                        <label for="filter">Filter Report</label>
                        <select name="filter" id="filter" class="form-control">
                            <option value="all" @if(Request::get('filter') == 'all') selected @endif>All</option>
                            <option value="daily" @if(Request::get('filter') == 'daily') selected @endif>Daily</option>
                            {{-- <option value="weekly" @if(Request::get('filter') == 'weekly') selected @endif>Weekly</option> --}}
                            <option value="monthly" @if(Request::get('filter') == 'monthly') selected @endif>Monthly</option>
                            <option value="yearly" @if(Request::get('filter') == 'yearly') selected @endif>Yearly</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="date">Date</label>
                        <select name="date" id="date" class="form-control">
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{strPad2digit($i)}}" @if(Request::get('date') == strPad2digit($i)) selected @endif>{{strPad2digit($i)}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="month">Month</label>
                        <select name="month" id="month" class="form-control">
                            @foreach(monthHuman() as $key=>$val)
                                <option value="{{$key}}" @if(Request::get('month') == $key) selected @endif>{{$val}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="year">Year</label>
                        <select name="year" id="year" class="form-control">
                            @for ($i = date('Y'); $i <= 2030; $i++)
                                <option value="{{$i}}" @if(Request::get('year') == $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                       
                        <input type="submit" id="action" value="Filter" class="btn btn-success w-100 mt-4">
                    </div>
                </form>
            </div>
        </div>
    {{-- card overview --}}
    <div class="row g-4 mb-4 mt-4">
        <div class="col-6 col-lg-6">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Rental</h4>
                    <div class="stats-figure">{{$totalRental}}</div>
                    <div class="stats-meta text-success">{{Request::get('filter')}}</div>
                </div>
                <!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
        </div>
        <!--//col-->

        <div class="col-6 col-lg-6">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Income</h4>
                    <div class="stats-figure">{{rupiah($totalIncome)}}</div>
                    <div class="stats-meta text-success">
                        {{Request::get('filter')}}
                    </div>
                </div>
                <!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
        </div>
    </div>
    <!--//row-->
        <div class="card mt-4">
            <div class="card-header">
               <div class="d-flex">
                <h4>Report Data</h4>
                <a href="/admin/export?d=report&filter={{Request::get('filter')}}&date={{Request::get('date')}}&month={{Request::get('month')}}&year={{Request::get('year')}}" class="btn btn-success position-absolute end-0">Download Excel</a>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover datatableAjax">
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
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
$(document).ready(function(){
    $('#filter').change(function()
    {
        const filterType = $('#filter').val();
    
    switch(filterType){
        case 'daily':
            $('#date').prop('disabled',false);
            $('#month').prop('disabled',false);
            $('#year').prop('disabled',false);
            break;
        case 'weekly':
            $('#date').prop('disabled',true);
            $('#month').prop('disabled',false);
            $('#year').prop('disabled',false);
            break;
        case 'monthly':
            $('#date').prop('disabled',true);
            $('#month').prop('disabled',false);
            $('#year').prop('disabled',false);
            break;
        case 'yearly':
            $('#date').prop('disabled',true);
            $('#month').prop('disabled',true);
            $('#year').prop('disabled',false);
            break;
        default:
            $('#date').prop('disabled',true);
            $('#month').prop('disabled',true);
            $('#year').prop('disabled',true);
            break;
    }
    });
});
</script>
@endsection