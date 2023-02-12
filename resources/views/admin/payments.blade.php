@extends('admin.layouts.general')

@section('content')
<div class="card mt-4">
    <div class="card-header">
       <div class="d-flex">
        <h4>Manage Payments Method</h4>
        <a href="/admin/payments/add" class="btn btn-success position-absolute end-0"><div class="fa fa-plus"></div> Add Payment</a>
       </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Primary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($payments as $u)
                    <tr>
                        <td><img src="{{$u->icon}}" style="width:100px;height:100px"></td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->description}}</td> 
                        <td>{{$u->primary == 1 ? 'YES' : 'NO'}}</td>
                        <td>{!! $u->status == 'active' ? '<span class="badge bg-success">ACTIVE</span>' : '<span class="badge bg-danger">INACTIVE</span>' !!}</td>
                        <td>
                            <a href="/admin/payments/{{$u->id}}/delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection