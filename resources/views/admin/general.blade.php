@extends('admin.layouts.general')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cog"></i>
            Web Settings
        </h3>
    </div>
    <div class="card-body">
        <form   action="/admin/setting" method="POST"  enctype="multipart/form-data">
            @csrf
            
            <div class="form-group row">
                <label for="icon" class="col-sm-2 col-form-label">Icon

                    <div id="iconPreview" class="m-3 mx-auto">
                        <img src="{{$edit->icon}}" alt="icon" class="img-thumbnail" style="width:50px;height:auto;margin:0 auto;">
                    </div>
                </label>
                <div class="col-sm-10">
                    <input type="file" name="icon" id="iconFile" accept="image/*" class="form-control">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title" placeholder="Title" value="{{$edit->title}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" placeholder="Name" value="{{$edit->name}}">
                </div> 
            </div>
            <div class="form-group row mt-2">
                <label for="meta_author" class="col-sm-2 col-form-label">Meta Author</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Meta Author" id="meta_author" name="meta_author" placeholder="Meta Author" value="{{$edit->meta_author}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Meta Description" id="meta_description" name="meta_description" placeholder="Meta Description" value="{{$edit->meta_description}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="meta_keywords" class="col-sm-2 col-form-label">Meta Keywords</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Meta Keywords" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" value="{{$edit->meta_keywords}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="terms" class="col-sm-2 col-form-label">Terms</label>
                <div class="col-sm-10">
                    <textarea class="form-control" style="height:200px" placeholder="Terms" id="terms" name="terms" placeholder="Terms">{{$edit->terms}}</textarea>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="privacy_policy" class="col-sm-2 col-form-label">Privacy Policy</label>
                <div class="col-sm-10">
                    <textarea class="form-control" style="height:200px" style="height:200px placeholder="Privacy Policy" id="privacy_policy" name="privacy_policy" placeholder="Privacy Policy">{{$edit->privacy_policy}}</textarea>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="about" class="col-sm-2 col-form-label">About</label>
                <div class="col-sm-10">
                    <textarea class="form-control" style="height:200px" placeholder="About" id="about" name="about" placeholder="About">{{$edit->about}}</textarea>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="gmaps_url" class="col-sm-2 col-form-label">Gmaps URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Gmaps URL" id="gmaps_url" name="gmaps_url" placeholder="Gmaps URL" value="{{$edit->gmaps_url}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Address" id="address" name="address" placeholder="Address" value="{{$edit->address}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email" placeholder="Email" value="{{$edit->email}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" placeholder="Phone" value="{{$edit->phone}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="offphone" class="col-sm-2 col-form-label">office Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Phone" id="offphone" name="office_phone" placeholder="Phone" value="{{$edit->office_phone}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Facebook" id="facebook" name="fb_url" placeholder="Facebook" value="{{$edit->fb_url}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="tiktok" class="col-sm-2 col-form-label">Tiktok URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="tiktok url" id="tiktok" name="tiktok_url" placeholder="tiktok" value="{{$edit->tiktok_url}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Instagram" id="instagram" name="ig_url" placeholder="Instagram" value="{{$edit->ig_url}}">
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
<script type="text/javascript">
    $(document).ready(function() {
   
      $("#iconFile").change(function() {
        let file = this.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onloadend = function() {
            $('#iconPreview').html(`<img src="${reader.result}" alt="icon" class="img-icon" style="width: 80%; height:auto;margin:0 auto;">`);
        }

      });
    });
</script>
@endsection