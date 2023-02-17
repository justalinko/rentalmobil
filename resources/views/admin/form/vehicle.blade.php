@extends('admin.layouts.general')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-car"></i>
            Vehicle
            @if($isEdit) Edit @else Add @endif
        </h3>
    </div>
    <div class="card-body">
        <form @if($isEdit) action="/admin/vehicles/{{$edit->id}}/edit" @else action="/admin/vehicles/add" @endif method="POST"  enctype="multipart/form-data">
            @csrf
            <div id="thumbnailPreview" class="m-3 mx-auto">
                    @if($isEdit)
                        <img src="{{$edit->thumbnail}}" alt="thumbnail" class="img-thumbnail" style="width:80%;height:auto;margin:0 auto;">
                    @endif
            </div>
            <div class="form-group row">
                <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail</label>
                <div class="col-sm-10">
                    <input type="file" name="thumbnail" id="thumbnailFile" accept="image/*" class="form-control">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control">
                        <option value="car" @if($isEdit) @if($edit->type == 'car') selected @endif @endif >Car</option>
                        <option value="motorcycle" @if($isEdit) @if($edit->type == 'motorcycle') selected @endif @endif >Motorcycle</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Ex: Brio 2020" id="name" name="name" placeholder="Name" value="{{$isEdit ? $edit->name : ''}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="brand" name="brand" placeholder="Ex: Honda" placeholder="Brand" value="{{$isEdit ? $edit->brand : ''}}">
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-sm-3">
                    <label for="seat">Seat ( Kursi )</label>
                    <input type="number" class="form-control" id="seat" name="seat" placeholder="Seat" value="{{$isEdit ? $edit->seat : ''}}">
                </div>
                <div class="col-sm-3">
                    <label for="luggage">Luggage ( Bagasi )</label>
                    <input type="number" class="form-control" id="luggage" name="luggage" placeholder="Luggage" value="{{$isEdit ? $edit->luggage : ''}}">
                </div>
                <div class="col-sm-3">
                    <label for="transmission">Transmission (Transmisi)</label>
                    <select name="transmission" id="transmission" class="form-control">
                        <option value="manual" @if($isEdit) @if($edit->transmission == 'manual') selected @endif @endif>Manual</option>
                        <option value="automatic" @if($isEdit) @if($edit->transmission == 'automatic') selected @endif @endif>Automatic</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="fuel">Fuel ( Bahan Bakar )</label>
                    <select name="fuel" id="fuel" class="form-control">
                        <option value="petrol" @if($isEdit) @if($edit->fuel == 'petrol') selected @endif @endif>Petrol / Bensin</option>
                        <option value="diesel" @if($isEdit) @if($edit->fuel == 'diesel') selected @endif @endif>Diesel / Solar</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-sm-3">
                    <label for="priceHour">+ Harga Late DropOff / Jam</label>
                    <input type="number" class="form-control" id="priceHour" name="price_hour" placeholder="Harga/Jam" value="{{$isEdit ? $edit->price_hour : ''}}">
                </div>
                <div class="col-sm-3">
                    <label for="priceDay">Harga/Hari</label>
                    <input type="number" class="form-control" id="priceDay" name="price_day" placeholder="Harga/Hari" value="{{$isEdit ? $edit->price_day : ''}}">
                </div>
                <div class="col-sm-3">
                    <label for="priceOther">Harga Lokasi Lain ( Dropoff & Pickup )</label>
                    <input type="number" class="form-control" id="priceOther" name="price_otherlocation" placeholder="Harga Lokasi Lain" value="{{$isEdit ? $edit->price_otherlocation : ''}}">
                </div>
                <div class="col-sm-3">
                    <label for="priceDriver">Harga Dengan Supir</label>
                    <input type="number" class="form-control" id="priceDirver" name="price_withdriver" placeholder="Harga dengan tambahan supir" value="{{$isEdit ? $edit->price_withdriver : ''}}">
                </div>
            </div>

            <div class="form-group row mt-2">
                <label for="stock" class="col-sm-3 col-form-label">Stock ( Dengan tipe yang sama )</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="stock" placeholder="10"  value="{{$isEdit ? $edit->stock : ''}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                    <textarea name="description" id="desc" class="form-control" style="height:150px">{{$isEdit ? $edit->description : ''}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Images List ( Preview )</label>
                <div class="input-group control-group increment" >
                    <input type="file" name="images[]" class="form-control">
                    <div class="input-group-btn"> 
                      <button class="btn btn-success" id="addFormUpl" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="clone hide">
                    <div class="control-group input-group" style="margin-top:10px">
                      <input type="file" name="images[]" class="form-control">
                      <div class="input-group-btn"> 
                        <button class="btn btn-danger btnpler" type="button"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
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
      $("#addFormUpl").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btnpler",function(){ 
          $(this).parents(".control-group").remove();
      });

      $("#thumbnailFile").change(function() {
        let file = this.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onloadend = function() {
            $('#thumbnailPreview').html(`<img src="${reader.result}" alt="Thumbnail" class="img-thumbnail" style="width: 80%; height:auto;margin:0 auto;">`);
        }

      });
    });
</script>
@endsection