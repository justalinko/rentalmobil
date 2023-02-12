@extends('admin.layouts.general')

@section('content')

<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-credit-card"></i>
            Payment
            @if($isEdit) Edit @else Add @endif
        </h3>
    </div>
    <div class="card-body">
        <form @if($isEdit) action="/admin/payments/{{$edit->id}}/edit" @else action="/admin/payments/add" @endif method="POST"  enctype="multipart/form-data">
            @csrf
            <div id="imagePreview">
                @if($isEdit)
                    <img src="{{$edit->icon}}" style="max-width:200px;height:auto;" alt="Image Preview" class="img-fluid">
                @endif
            </div>
            <div class="form-group row mt-2">
                <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" placeholder="Icon" id="icon" name="icon">
                </div>
            </div>
            
            <div class="form-group row mt-2">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" placeholder="Name Payment" value="{{$isEdit ? $edit->name : ''}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="desc" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                   <textarea name="description" id="desc" cols="30" rows="10" placeholder="Bank transfer BCA A/N Bla bla NO. Rek : 29839238" class="form-control">{{$isEdit ? $edit->description : ''}}</textarea>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="primary" class="col-sm-2 col-form-label">Primary</label>
                <div class="col-sm-10">
                    <select name="primary" id="primary" class="form-control">
                        <option value="1" @if($isEdit && $edit->primary == 1) selected @endif>YES</option>
                        <option value="0" @if($isEdit && $edit->primary == 0) selected @endif>NO</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="role" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" id="role" class="form-control">
                        <option value="active" @if($isEdit && $edit->status == 'active') selected @endif>ACTIVE</option>
                        <option value="inactive" @if($isEdit && $edit->status == 'inactive') selected @endif>INACTIVE</option>
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



@section('js')
<script>
    $('#icon').change(function(){

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').html('<img src="'+e.target.result+'" style="max-width:200px;height:auto;" alt="Image Preview" class="img-fluid">');
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

</script>
@endsection