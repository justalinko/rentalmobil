@extends('admin.layouts.general')


@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Vehicles Availability Check</h1>
    </div>
 
    <!--//col-auto-->
</div>
<div class="card">
    <form method="get" action="/admin/vehicles/check">
        
    <div class="card-body row">
        <div class="col-3">
            <label for="start">From Date</label>
            <input type="text" class="form-control" id="from_date" name="from_date" value="{{date('d-m-Y')}}">
        </div>
        <div class="col-3">
            <label for="end">To Date</label>
            <input type="text" class="form-control" id="to_date" name="to_date" value="{{date('d-m-Y' , strtotime('+1 Day'))}}">
        </div>
        <div class="col-3">
            <label for="vehicles">Vehicles Item</label>
            <select name="vehicles" id="vehicles" class="form-control">
                <option value="all">All</option>
                @foreach(\App\Models\Armada::all() as $vehicle)
                    <option value="{{$vehicle->id}}">{{$vehicle->type}} | {{$vehicle->brand}} {{$vehicle->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
         
            <input type="submit" id="action" value="Filter" class="btn btn-success w-100 mt-4">
        </div>
    </div>
</form>
</div>
@if($check)
<div class="card mt-2">
    <div class="alert alert-info">
        @if(count($checkData) > 0)
        <h1>{{$checkData->armada->brand}} {{$checkData->armada->name}}</h1>
        <h3>Stock : {{$checkData->armada->stock}}</h3>
        <h3>Used : {{$checkData->armada->used}}</h3>
        <h3>Available : {{$checkData->armada->stock - $checkData->armada->used}}</h3>
        @else
        <h1>No Vehicle Found</h1>
        @endif
    </div>
</div>

@endif


<div class="card mt-5">
    <div class="card-header">
        <h3>Vehicles Available</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover datatable">
            <thead>
                <th>Type</th>
                <th>Name</th>
                <th>Total Stock</th>
                <th>Total Used</th>
                <th>Available</th>
              
                
            </thead>

            <tbody>
                @php
                    
                    function typex($type)
                    {
                        if($type == 'car')
                        {
                            return '<span class="badge bg-success text-white"><i class="fas fa-car"></i></span>';
                        }else{
                            return '<span class="badge bg-primary text-white"><i class="fas fa-motorcycle"></i> </span>';
                        }
                    }
                @endphp
                @foreach($armadas as $vehicle)
                @if($vehicle->stock - $vehicle->used == 0) @continue @endif
                <tr>
                    <td>{{$vehicle->type}}</td>
                    <td>{{$vehicle->brand}} {{$vehicle->name}}</td>
                    <td>{{$vehicle->stock}} {!!typex($vehicle->type)!!}</td>
                    <td>{{$vehicle->used}} {!!typex($vehicle->type)!!}</td>
                    <td>{{$vehicle->stock - $vehicle->used}} {!!typex($vehicle->type)!!}</td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('js')

<script>

$('#from_date').datepicker({
      
                format: 'd-m-yyyy',
                autoclose:true
            });
            $('#to_date').datepicker({
        
                format: 'd-m-yyyy',
                autoclose:true
            });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">
@endsection