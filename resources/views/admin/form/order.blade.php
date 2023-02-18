@extends('admin.layouts.general')

@section('content')

<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-shopping-cart"></i>
            Order
            @if($isEdit) Edit @else Add @endif
        </h3>
    </div>
    <div class="card-body">
        <form @if($isEdit) action="/admin/orders/{{$edit->id}}/edit" @else action="/admin/orders/add" @endif method="post">
            @csrf
            
            <div class="form-group row">
                <label for="vehicles" class="col-2">Vehicles</label>
                <div class="col-10">
                <select name="vehicles" id="vehicles" class="form-control">
                    @foreach (\App\Models\Armada::all() as $vehicle)
                    @if($vehicle->stock == $vehicle->used) @continue @endif
                    <option value="{{$vehicle->id}}" data-price="{{$vehicle->price_day}}" @if($isEdit) @if($edit->armada_id == $vehicle->id) selected @endif @endif>{{$vehicle->type}} - {{$vehicle->brand}} {{$vehicle->name}} ( {{rupiah($vehicle->price_day)}} / day)</option>
                    @endforeach
                </select>
            </div>
            </div>

            <div class="form-group row mt-2">
                <label for="customer_type" class="col-2"> Customer Type</label>
                <div class="col-10">
                <select name="customer_type" id="customer_type" class="form-control">
                    <option value="user" @if($isEdit) @if($edit->customer_type == 'user') selected @endif @endif>User</option>
                    <option value="agent" @if($isEdit) @if($edit->customer_type == 'agent') selected @endif @endif>Agency</option>
                </select>
            </div>
            </div>
            <div class="form-group row mt-2">
                <label for="services_type" class="col-2"> Services</label>
                <div class="col-10">
                <select name="services_type" id="services_type" class="form-control">
                    <option value="without_driver" @if($isEdit) @if($edit->service_type == 'without_driver') selected @endif @endif>No Driver</option>
                    <option value="with_driver" @if($isEdit) @if($edit->service_type == 'with_driver') selected @endif @endif>With Driver</option>
                </select>
            </div>
            </div>
            
            <div class="row mt-2">
                <div class="col-6">
                    <div class="form-group row">
                        <label for="pickup_type">Pick Up location</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <select name="pickup_type" id="pickup_type" >
                                        <option value="office" @if($isEdit) @if($edit->pickup_type == 'office') selected @endif @endif>Office</option>
                                        <option value="other_location" @if($isEdit) @if($edit->pickup_type == 'other_location') selected @endif @endif>Other Location</option>
                                    </select>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="pickup_address"  id="pickup_address" @if($isEdit) value="{{$edit->pickup_address}}" @endif  disabled>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label for="dropoff_type">Drop Off location</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <select name="dropoff_type" id="dropoff_type" >
                                        <option value="office"  @if($isEdit) @if($edit->dropoff_type == 'office') selected @endif @endif>Office</option>
                                        <option value="other_location" @if($isEdit) @if($edit->dropoff == 'other_location') selected @endif @endif>Other Location</option>
                                    </select>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="dropoff_address" id="dropoff_address"  @if($isEdit) value="{{$edit->dropoff_address}}" @endif disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="text" name="start_date" id="rental_start" class="form-control" @if($isEdit) value="{{$edit->start_date}}" @else value="{{date('d-m-Y')}}" @endif>
                    </div>
                </div>
                <div class="col-6">
                
                    <label for="start_time">Start Time</label>
                    <input type="text" name="start_time" @if($isEdit)  value="{{$edit->start_time}}" @else value="{{date('H:i')}}" @endif class="form-control tempek">
                </div>

                <div class="col-6">
                    <label for="end_date">End Date</label>
                    <input type="text" name="end_date" id="rental_end" class="form-control"  @if($isEdit) value="{{$edit->end_date}}" @else value="{{date('d-m-Y',strtotime('+1 day'))}}" @endif>
                </div>
                <div class="col-6">
                    <label for="end_time">End Time</label>
                    <input type="text" @if($isEdit)  value="{{$edit->end_time}}" @else value="{{date('H:i')}}" @endif  name="end_time"  class="form-control tempek">
                </div>
            </div>

            <div class="mt-4">
                   <!-- generate input : name,email,phone -->
            @foreach (['name','email','phone'] as $input)
            <div class="form-group row mt-2">
                <label for="{{$input}}" class="col-2">{{ucfirst($input)}}</label>
                <div class="col-10">
                    <input type="text" name="{{$input}}" id="{{$input}}" placeholder="{{$input}}" class="form-control" @if($isEdit) value="{{$edit->$input}}" @endif>
                </div>
            </div>
        @endforeach
            </div>
            <div class="form-group row mt-3">
                <label for="contact_type" class="col-2">Contact Type</label>
                <div class="col-10">
                    <select name="contact_type" class="form-control">
                        <option value="whatsapp" @if($isEdit) @if($edit->contact_type == 'whatsapp') selected @endif @endif>Whatsapp</option>
                        <option value="telegram" @if($isEdit) @if($edit->contact_type == 'telegram') selected @endif @endif>Telegram</option>
                    </select>
                </div>
            </div>
          
            <div class="form-group row mt-3">
                <label for="contact_id" class="col-2">Contact ID</label>
                <div class="col-10">
                    <input type="text" name="contact_id" id="contact_id" @if($isEdit) value="{{$edit->contact_id}}" @endif placeholder="Whatsapp number or telegram id" class="form-control">
                </div>
            </div>
            @if(!$isEdit)
            <div class="form-group row mt-2">
                <label for="dp" class="col-2">Down Payment </label>
                <div class="col-10">
                    <input type="number" name="addForm[downpayment]" id="dp" placeholder="100000" class="form-control">
                </div>
            </div>
            <div class="wrapper-clone">  
            <div class="form-group row mt-2">
                <!-- deposit -->
                <label for="deposit" class="col-2">Deposit </label>
                <div class="col-10">
                    <div class="input-group">
                        <input type="number" name="addForm[deposit]" id="deposit" placeholder="Deposit" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-success" id="addFormClick" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            @endif
            @if($isEdit)

            <div class="wrapper-clone">
            @if($edit->additional_input !== null && is_array(json_decode($edit->additional_input,true)))
            @foreach (@json_decode($edit->additional_input) as $key => $item)
            <div class="form-group row mt-2">
                <!-- deposit -->
                <label for="addForm[{{$key}}]" class="col-2">{{ucfirst($key)}} </label>
                <div class="col-10">
                    <div class="input-group">
                        <input type="text" name="addForm[{{$key}}]" id="{{$key}}" placeholder="{{$key}}" class="form-control" >
                        <div class="input-group-btn">
                            @if($loop->first)
                            <button class="btn btn-success" id="addFormClick" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                            @else
                            <button class="btn btn-danger remove_button" type="button"><i class="fa fa-minus"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="form-group row mt-2">
                <label for="addBtn" class="col-2">Add Form </label>
                <div class="col-10">
                    <button class="btn btn-success w-100 text-white" id="addFormClick" type="button">
                        <i class="fa fa-plus"></i> Add Input Form
                    </button>
                </div>
            </div>
            @endif
            </div>

            @endif


            <div class="form-group mt-3 row">
                <label for="payment_method" class="col-2">Payment Method</label>
               <div class="col-10">
                <select name="payment_method" id="payment_method" class="form-control select2">
                    @foreach (\App\Models\PaymentMethod::all() as $pm)
                        <option value="{{$pm->name}}" @if($isEdit) @if($edit->payment_method == $pm->name) selected @endif @endif>{{$pm->name}} - {{$pm->description}}</option>
                    @endforeach
                </select>
               </div>
            </div>
            @php $allStatus = ['waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' , 'on_going','cancelled' , 'finished']; @endphp
            <div class="form-group mt-3 row">
                <label for="status" class="col-2">Status Order</label>
               <div class="col-10">
                <select name="status" id="status" class="form-control select2">
                    @foreach ($allStatus as $st)
                        <option value="{{$st}}" @if($isEdit) @if($edit->status == $st) selected @endif @endif>{{str_replace('_', ' ',$st)}}</option>
                    @endforeach
                </select>
               </div>
            </div>
            <div class="form-group mt-3 row">
                <label for="total_price" class="col-2"> Total Price</label>
                <div class="col-10">
                    <input type="number" name="total_price" id="total_price" placeholder="Total Price" class="form-control" @if($isEdit) value="{{$edit->total_price}}" @endif>
                    <small><i>Mohon perhatikan tentang total harga, total harga di buat <b>semi-otomatis dari harga kendaraan dikali durasi rental</b></i></small>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary text-white w-100"><i class="fa fa-share"></i> Save Order</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script>
function htmlTemplt(id)
{
    var fieldHTML = '<div class="form-group row mt-3">';
        fieldHTML+= '<div class="col-4"><input type="text" name="addFormName[]" onchange="gimmeName('+id+')" id="y_'+id+'" class="form-control" placeholder="Name ( ex : Additional Payment )" > </div>';
        fieldHTML+= '<div class="col-8"><div class="input-group"><input type="text" id="x_'+id+'" placeholder="Additional Form Value" class="form-control"><div class="input-group-btn"><button class="btn btn-danger remove_button" type="button"><i class="fa fa-minus"></i></button></div></div>'; //New input field html
        fieldHTML+= '</div></div>';
    return fieldHTML;
}

function gimmeName(id)
{
    console.log(id);
    let label = $('#y_'+id).val();
    $('#x_'+id).attr('name','addForm['+label+']');

}
$(document).ready(function(){

    let maxField = 10; //Input fields increment limitation
    let addButton = $('#addFormClick'); //Add button selector
    let wrapper = $('.wrapper-clone'); //Input field wrapper
    let x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            let fieldHTML = htmlTemplt(x);
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $('#pickup_type').on('change',function(){
        if($(this).val() == 'other_location'){
            $('#pickup_address').prop('disabled',false);
        }else{
            $('#pickup_address').prop('disabled',true);
            $('#pickup_address').val('Office');
        }
    });

    $('#dropoff_type').on('change',function(){
        if($(this).val() == 'other_location'){
            $('#dropoff_address').prop('disabled',false);
        }else{
            $('#dropoff_address').prop('disabled',true);
            $('#dropoff_address').val('Office');
        }
    });

    $('input[name=addFormName]').on('change',function(){
        console.log($(this).val());
    });

    $('#rental_start').datepicker({
                startDate: '1d',
                format: 'd-m-yyyy',
                autoclose:true
            });
            $('#rental_end').datepicker({
                startDate: '+1d',
                format: 'd-m-yyyy',
                autoclose:true
            });

	        $('.tempek').timepicker({
                showMeridian: false,
                timeFormat: 'H:i'
            });
    $('#rental_end,#rental_start,#vehicles').change(function(){

        //** get rental duration **/
        let start = $('#rental_start').val();
        let starti = start.split('-');
        let startt = starti[1]+'/'+starti[0]+'/'+starti[2];
        let end = $('#rental_end').val();
        let endi = end.split('-');
        let endt = endi[1]+'/'+endi[0]+'/'+endi[2];
        let start_date = new Date(startt);
        let end_date = new Date(endt);
        let diff = end_date.getTime() - start_date.getTime();
        let duration = diff / (1000 * 3600 * 24);
        //** get rental duration **/

        let Price = $('#vehicles').find(':selected').data('price');
        let total = Price * duration;
        $('#total_price').val(total);

    });


});
</script>
@endsection


@section('css')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">
@endsection