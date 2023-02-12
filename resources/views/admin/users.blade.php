@extends('admin.layouts.general')

@section('content')
<div class="card mt-4">
    <div class="card-header">
       <div class="d-flex">
        <h4>Manage Users</h4>
        <a href="/admin/users/add" class="btn btn-success position-absolute end-0"><div class="fa fa-plus"></div> Add Users</a>
       </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->role}}</td> 
                        <td>{{$u->created_at}}</td>
                        <td>
                            <a href="/admin/users/{{$u->id}}/edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="/admin/users/{{$u->id}}/delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection