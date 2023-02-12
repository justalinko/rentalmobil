@extends('admin.layouts.general')

@section('content')

<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-users"></i>
            User
            @if($isEdit) Edit @else Add @endif
        </h3>
    </div>
    <div class="card-body">
        <form @if($isEdit) action="/admin/users/{{$edit->id}}/edit" @else action="/admin/users/add" @endif method="POST"  enctype="multipart/form-data">
            @csrf

           
            <div class="form-group row mt-2">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" placeholder="Name" value="{{$isEdit ? $edit->name : ''}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="brand" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$isEdit ? $edit->email : ''}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="brand" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{$isEdit ? $edit->password : ''}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="role" class="col-sm-2 col-form-label">Role / Level</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        <option value="user" @if($isEdit && $edit->role == 'user') selected @endif>User</option>
                        <option value="admin" @if($isEdit && $edit->role == 'admin') selected @endif>Admin</option>
                    </select>
                </div>
            </div>


            <div class="form-group mt-4">
                <button class="btn btn-success w-100"><i class="fa fa-save"></i> Save</button>
            </div>
           
        </form>
    </div>
</div>
@endsection

