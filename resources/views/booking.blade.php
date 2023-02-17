@extends('layouts.general')

@section('content')
    <!-- list mobil -->
    <section class="ftco-section bg-light pt-5">
        <div class="container-fluid">
            <form method="POST" action="/booking" >
                @csrf
                <input type="hidden" name="id" value="{{$book->id}}">
                <input type="hidden" id="driver_price" value="{{$book->price_withdriver}}" name="driver_price">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-md-4">
                                            <img src="{{ $book->thumbnail }}" alt=""
                                                class="img-fluid rounded w-100 shadow-sm">
                                        </div>
                                        <div class="col-md-8 p-3">
                                            <h4 class="card-text font-weight-bold">{{ $book->name }}</h4>
                                            <div class="d-flex justify-content-between p-1 mb-2">
                                                <h5 class="text-danger"><i class="flaticon-car-seat"></i> {{ $book->seat }} Seats
                                                </h5>
                                                <h5 class="text-success"><i class="flaticon-backpack"></i> {{ $book->luggage }}
                                                    Luggage</h5><br>
                                                <h5 class="text-info"><i class="flaticon-pistons"></i> {{ $book->transmission }}
                                                </h5>
                                                <h5 class="text-warning"><i class="flaticon-diesel"></i> {{ $book->fuel }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bold">{{__('Personal Information')}}</h5>
                                    <input type="text" name="name" class="form-control mb-3" placeholder="Your Name" id="name" required>
                                    <input type="email" class="form-control mb-3" placeholder="your@email"
                                        name="email" id="email" required>
                                    <p class="text-danger font-italic mb-0 font-sm">{{__('* Masukkan nomor whatsapp')}}</p>
                                    <input type="text" class="form-control mb-3"
                                        placeholder="Your Phone Number" name="phone" id="phone"
                                        required>
                                </div>
                            </div>
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bold">{{__('CONTACT INFORMATION')}}</h5>
                                    <div class="input-group mb-3 border-0">
                                        <select class="custom-select border-danger" name="contact_type" id="contactInfo">
                                            <option value="whatsapp">{{__('WhatsApp')}}</option>
                                            <option value="telegram">{{__('Telegram')}}</option>
                                        </select>
                                    </div>
                                    <input type="text" name="contact_id" class="form-control" placeholder="Your Contact ID  ( Whatsapp Number or Telegram ID)">
                                </div>
                            </div>
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bold">{{__('CHOOSE SERVICES TYPE')}}</h5>
                                    <div class="input-group mb-3 border-0">
                                        <select class="custom-select border-danger" name="service_type" id="serviceInput">
                                            <option value="without_driver">{{__('Without Driver')}}</option>
                                            <option value="with_driver">{{__('With Driver')}}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bold text-dark"><i class="fa-solid fa-location-dot text-danger"></i>
                                        {{__('pickup_location')}}</h5>
                                    <div class="input-group mb-3 border-0">
                                        <select class="custom-select" name="pickup_type" id="pengambilan">
                                            <option value="" selected>{{__('select car pick-up')}}</option>
                                            <option value="kantor" @if($isDirect) @if($direct->pickup_type == 'office') selected @endif @endif  >{{__('office')}}</option>
                                            <option value="lokasi_lain" @if($isDirect) @if($direct->pickup_type == 'other_location') selected @endif @endif>{{__('other location')}}</option>
                                        </select>
                                    </div>
                                    <div id="formKantor" class="bg-light" @if($isDirect) @if($direct->pickup_type == 'office') style="display:block" @else style="display: none;" @endif  @else style="display: none;" @endif >
                                        <h5>{{__('cost')}} : <span class="text-success"> Free</span></h5>
                                        <h6 class="text-dark">{{__('location')}} : <span>Kantor Rental Mobil</span></h6>
                                    </div>
                                    <div id="formLain" class="bg-light p-3" @if($isDirect) @if($direct->pickup_type == 'other_location') style="display:block" @else style="display: none;" @endif  @else style="display: none;" @endif>
                                        <h5>{{__('cost')}} : <span>{{rupiah($book->price_otherlocation)}}</span></h5>
                                        <label class="text-dark">{{__('location')}} :</label>
                                        <input type="text" id="address_pickup" @if($isDirect) @if($direct->pickup_type == 'other_location') value="{{$direct->pickup_address}}" @endif @endif name="pickup_address" class="form-control" placeholder="Ex. Bali">
                                        <p>{{__('nb')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bold text-dark"><i class="fa-solid fa-location-dot text-danger"></i>
                                        {{__('drop_off location')}}</h5>
                                    <div class="input-group mb-3 border-0">
                                        <select class="custom-select" name="dropoff_type" id="pengembalian">
                                            <option value="" selected>{{__('select car return')}}</option>
                                            <option value="kantor" @if($isDirect) @if($direct->dropoff_type == 'office') selected @endif @endif>{{__('office')}}</option>
                                            <option value="lokasi_lain" @if($isDirect) @if($direct->dropoff_type == 'other_location') selected @endif @endif>{{__('other location')}}</option>
                                        </select>
                                    </div>
                                    <div id="pengembalianKantor" class="bg-light"@if($isDirect) @if($direct->dropoff_type == 'office') style="display:block" @else style="display: none;" @endif  @else style="display: none;" @endif>
                                        <h5>{{__('cost')}} : <span class="text-success"> Free</span></h5>
                                        <h6 class="text-dark">{{__('location')}} : <span>Kantor Rental Mobil</span></h6>
                                    </div>
                                    <div id="pengembalianLuar" class="bg-light p-3" @if($isDirect) @if($direct->dropoff_type == 'other_location') style="display:block" @else style="display: none;" @endif  @else style="display: none;" @endif>
                                        <h5>{{__('cost')}} : <span>{{rupiah($book->price_otherlocation)}}</span></h5>
                                        <label class="text-dark">{{__('location')}} :</label>
                                        <input type="text" id="address_dropoff" @if($isDirect) @if($direct->dropoff_type == 'other_location') value="{{$direct->dropoff_address}}" @endif @endif name="dropoff_address" class="form-control" placeholder="Ex. Bali">
                                        <p>{{__('nb')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>

                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bold text-dark"><i
                                            class="fa-solid fa-clock-rotate-left text-danger"></i> {{__('rental duration')}}</h5>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="" class="text-dark">{{__('rental start date')}}</label>
                                            <div class="input-group date mb-3 border-0">
                                                <input type="text" name="start_date" @if($isDirect) value="{{$direct->pickup_date}}" @else value="{{date('d-m-Y')}}" @endif id="rental_start" class="custom-select">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="text-dark">{{__('rental start time')}}</label>
                                            <div class="input-group mb-3 border-0">
                                                <input type="text" name="start_time" id="rental_time_start" @if($isDirect) value="{{$direct->pickup_time}}" @else value="{{date('H:i')}}" @endif class="custom-select tempek">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="" class="text-dark">{{__('rental end date')}}</label>
                                            <div class="input-group mb-3 border-0 date">
                                                <input type="text" name="end_date"  id="rental_end" class="custom-select" @if($isDirect) value="{{$direct->dropoff_date}}" @else value="{{ date("d-m-Y", strtotime("+1 day")) }}" @endif>
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="text-dark">{{__('rental end time')}}</label>
                                            <div class="input-group mb-3 border-0">
                                                <input type="text" name="end_time" id="rental_time_end" value="{{date('H:i')}}" class="custom-select tempek"></input>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-info" id="rentalDuration" style="display: none"></div>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h5 class="font-weight-bold text-dark">{{__('rental policy')}}</h5>
                                        <!-- Term And Condition -->
                                        <button type="button" class="btn btn-danger font-weight-normal btn-sm" data-toggle="modal"
                                            data-target=".bd-example-modal-lg">
                                            {{__('terms and conditions')}} <span><i class="fa-solid fa-arrow-right"></i></span>
                                        </button>
                                    </div>
                                    <p><i class="fa-regular fa-clock"></i> {{__('Usage of up to 24 hours per rental day')}}</p>
                                    <p><i class="fa-solid fa-gas-pump"></i> {{__('Return the fuel as received')}}</p>
                                    <p><i class="fa-solid fa-clock-rotate-left"></i> {{__('24/7 emergency roadside assistance')}}</p>
                                    <p><i class="fa-solid fa-dollar-sign"></i> {{__('refundable')}}</p>
                                </div>
                            </div>


                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h5 class="font-weight-bolder text-dark">{{__('important information')}}</h5>

                                    <label class="text-dark font-weight-bold mb-0">{{__('before you book')}}</label>
                                    <li>Make sure to read the rental requirements.</li>
                                    <li>Car rental time must be start 6 hours before pick up time.</li>

                                    <label class="text-dark font-weight-bold mb-0">{{__('after you book')}}</label>
                                    <li>The Rental provider will refund your payment if the car unavailable.</li>
                                    <li>The rental provider will inform to you about car availbility</li>

                                    <label class="text-dark font-weight-bold mb-0">{{__('during pick-up')}}</label>
                                    <li>Bring your ID card, driver1s license, and other documents as required by the rental
                                        provider.</li>
                                    <li>When you meet with the rental staff, check the car`s condition together with the staff.</li>
                                    <li>After that, read and sign the rental agreement.</li>
                                </div>
                            </div>
                            <div class="card shadow-sm border-0">
                                <div class="d-flex justify-content-between align-items-center mb-1 m-2">
                                    <h5 class="font-weight-bold text-dark">{{__('total price')}} : <span id="totalPriceX"></span></h5>
                                    <!-- Term And Condition -->
                                    <!-- Button trigger modal -->
                                    <div class="">
                                        <button type="button" id="konfirm" data-toggle="modal" data-target="#totalPrice"  class="btn btn-success"><i class="fa fa-shopping-cart"></i> {{__('Confirm')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="totalPrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="totalPrice">{{__('price details')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                                <div class="card shadow-sm border-0 p-3">
                                    <h5 class="font-weight-bold">{{__('price detail')}}</h5>
                                    <div class="mt-1 mb-2">
                                        <h6 class="mb-0 text-dark font-weight-bold">{{__('car type')}}</h6>
                                        <span>{{ $book->name }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-1 mb-2">
                                            <h6 class="mb-0 text-dark font-weight-bold">{{__('transmission')}}</h6>
                                            <span>{{ $book->transmission }}</span>
                                        </div>
                                        <div class="mt-1 mb-2">
                                            <h6 class="mb-0 text-dark font-weight-bold">{{__('service')}}</h6>
                                            <span id="service">Without Driver</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-1 mb-2">
                                            <h6 class="mb-0 text-dark font-weight-bold">{{__('rental duration')}}</h6>
                                            <span id="rent_duration"></span>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-2">
                                        <h6 class="mb-0 text-dark font-weight-bold">{{__('pick-up location')}}</h6>
                                        <span id="pickup_loc2">-</span>
                                    </div>
                                    <div class="mt-1 mb-2">
                                        <h6 class="mb-0 text-dark font-weight-bold">{{__('drop-off location')}}</h6>
                                        <span id="dropoff_loc2">-</span>
                                    </div>
                                    <div class="bg-light rounded p-2">
                                        <span class="font-sm">{{__('total price')}}</span>
                                        <h5 class="font-weight-bold text-dark" id="total_price"></h5>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="font-sm">{{__('basic price')}} :</span>
                                            <span class="font-sm" id="price_rental">Rp. {{ $book->price_day }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="font-sm">{{__('Pick-up in other location')}} :</span>
                                            <span class="font-sm" id="price_pickup">Rp. 0-,</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="font-sm">{{__('Drop-off in other location')}} :</span>
                                            <span class="font-sm" id="price_dropoff">Rp. 0-,</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="font-sm">{{__('Additional Services')}} :</span>
                                            <span class="font-sm" id="add_service">Rp. 0-,</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block" id="konfirm"><i class="fa fa-shopping-cart"></i> {{__('Continue to Payment')}}</button>
                            </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </section>
    <!-- end list mobil -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body overflow-auto" style="max-height: 450px;">
                    <h5 class="text-dark font-weight-bold">A. Sebelum Pengambilan</h5>
                    <p class="mb-0">
                        1. Pengemudi harus membagikan kepada penyedia foto SIM A atau SIM Internasional mereka. <br>
                        2. Pengemudi harus membagikan kepada penyedia foto KTP/paspor mereka. <br>
                        3. Pengemudi harus membagikan kepada penyedia foto kartu kredit mereka <br>
                        4. Jika pengemudi tidak memiliki kartu kredit, pengemudi harus menggantikannya dengan 2 dokumen dari
                        pilihan berikut: NPWP, BPJS, atau Akte Lahir, Kartu Keluarga, Kartu Identitas Karyawan, Paspor,
                        Ijazah Sekolah Terakhir, Kartu Tanda Anggota Polri / TNI. <br>
                        5. Pengemudi harus membayar deposit sebesar Rp 1.000.000 melalui transfer kepada jayamahe sebelum
                        rental dimulai. <br>
                        6. Pengemudi wajib memberikan alamat email saat serah terima kendaraan untuk menerima bukti transfer
                        pengembalian deposit. <br>
                        7. Deposit akan dikembalikan paling lambat 5 hari kerja setelah rental berakhir. <br>
                        8. Penyewa yang ingin meminta kursi bayi atau plat ganjil atau genap dapat menulis permintaanya di
                        bawah halaman Permintaan Khusus pada halaman pesanan.. <br>
                        9. Semua permintaan khusus tergantung dari ketersediaan penyedia rental dan dapat dikenakan biaya
                        tambahan. <br>
                        10. Jika penyedia tidak dapat memenuhi permintaan khusus penyewa (cth: mobil dengan plat ganjil
                        habis), penyewa dapat mengajukan refund asalkan pengajuan dilakukan lebih dari 24 jam sebelum waktu
                        pengambilan. <br>
                        11. Pengemudi harus memenuhi syarat paling lambat 6 jam sebelum pengambilan. Jika tidak, pesanan
                        tidak bisa di-refund jika pengemudi tidak dapat memenuhi syarat <br>
                        12. Batas Pengantaran kendaraan maksimal 15km dari kantor rental, apabila melebihi 15km maka anda
                        akan di kenakan biaya tambahan sesuai lokasi pengantaran anda, admin kami akan menginformasikan
                        kepada anda mengenai biaya tambahan. <br>
                    </p>
                    <h5 class="text-dark font-weight-bold">B. Saat Pengambilan</h5>
                    <p class="mb-0">
                        1. Pengemudi harus menunjukkan Kartu Identitas atau Paspor. <br>
                        2. Pengemudi harus menunjukkan SIM A atau SIM Internasional yang masih berlaku. <br>
                        3. Pengemudi harus berusia antara 18 – 75 tahun <br>
                        4. Jika pengemudi tidak memiliki kartu kredit, pengemudi harus menggantikannya dengan 2 dokumen dari
                        pilihan berikut: NPWP, BPJS, atau Akte Lahir, Kartu Keluarga, Kartu Identitas Karyawan, Paspor,
                        Ijazah Sekolah Terakhir, Kartu Tanda Anggota Polri / TNI. <br>
                        5. Pengemudi harus membayar deposit sebesar Rp 1.000.000 melalui transfer kepada jayamahe sebelum
                        rental dimulai. <br>
                        6. Pengemudi wajib memberikan alamat email saat serah terima kendaraan untuk menerima bukti transfer
                        pengembalian deposit. <br>
                        7. Deposit akan dikembalikan paling lambat 5 hari kerja setelah rental berakhir. <br>
                        8. Penyewa yang ingin meminta kursi bayi atau plat ganjil atau genap dapat menulis permintaanya di
                        bawah halaman Permintaan Khusus pada halaman pesanan.. <br>
                        9. Semua permintaan khusus tergantung dari ketersediaan penyedia rental dan dapat dikenakan biaya
                        tambahan. <br>
                        10. Jika penyedia tidak dapat memenuhi permintaan khusus penyewa (cth: mobil dengan plat ganjil
                        habis), penyewa dapat mengajukan refund asalkan pengajuan dilakukan lebih dari 24 jam sebelum waktu
                        pengambilan. <br>
                        11. Pengemudi harus memenuhi syarat paling lambat 6 jam sebelum pengambilan. Jika tidak, pesanan
                        tidak bisa di-refund jika pengemudi tidak dapat memenuhi syarat <br>
                        12. Batas Pengantaran kendaraan maksimal 15km dari kantor rental, apabila melebihi 15km maka anda
                        akan di kenakan biaya tambahan sesuai lokasi pengantaran anda, admin kami akan menginformasikan
                        kepada anda mengenai biaya tambahan. <br>
                    </p>
                </div>
                <div class="modal-footer">
                  
                    <button type="button" data-dismiss="modal" class="btn btn-primary">{{__('accept')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>

        function calculatePrice(type, duration,pid)
        {
            if($('#pengambilan').val() == 'kantor')
            {
                var addPickup = 0;
            }else{
                var addPickup = 1;
            }
            if($('#pengembalian').val() == 'kantor')
            {
                var addDropoff = 0;
            }else{
                var addDropoff = 1;
            }
            if($('#serviceInput').val() == 'with_driver')
            {
                var addDriver = 1;
            }else{
                var addDriver = 0;
            }
            $.ajax({
                url : '/api/rent-price?type='+type+'&duration='+duration+'&pid='+pid+'&pickup='+addPickup+'&dropoff='+addDropoff + '&driver='+addDriver,
                type : 'GET',
                success:function(data)
                {
                    $('#total_price').html(data.total_human);
                    $('#price_pickup').html(data.pickup_human);
                    $('#price_dropoff').html(data.dropoff_human);
                    $('#price_rental').html(data.base_human + '/ ' + type);
                    $('#totalPriceX').html(data.total_human);
                    $('#add_service').html('With Driver ( + '+ data.driver_human + ' )');
                },
                error:function(data)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        btnConfirm: false,
                        timer: 2000
                    } , function(){
                        window.location.reload();
                    });
                }
            })
        }

        function ayoBerhitung()
        {
            var startDate = $('#rental_start').val();
                var startTime = $('#rental_time_start').val();
                parseStart = startDate.split('-');
                startDate = parseStart[1]+'/'+parseStart[0]+'/'+parseStart[2]+' '+startTime+':00';
                var endDate = $('#rental_end').val();
                var endTime = $('#rental_time_end').val();
                parseEnd = endDate.split('-');
                endDate = parseEnd[1]+'/'+parseEnd[0]+'/'+parseEnd[2]+' '+endTime+':00';

                var dateStart = new Date(startDate);
                var dateEnd = new Date(endDate);
                var DifferenceTime = dateEnd.getTime() - dateStart.getTime();
                var timeToHour = DifferenceTime / (1000 * 3600);
                timeToHour = Math.floor(timeToHour);
                var DifferenceDay = DifferenceTime / (1000 * 3600 * 24);
                DifferenceDay = Math.floor(DifferenceDay);
            $('#rentalDuration').show();
            if(DifferenceDay == 0)
            {
                var type = 'hour';
                var dur = timeToHour;
                var msg = 'Rental Duration : ' + timeToHour + ' Hours';
            }else{
                var type = 'day';
                var dur = DifferenceDay;
                var msg = 'Rental Duration : ' + DifferenceDay + ' Day';
            }
            $('#rentalDuration').html(msg);
            $('#rent_duration').html(msg);
            calculatePrice(type ,dur , {{$book->id}})
        }
        
        $(document).ready(function() {
            $('#pengambilan').change(function() {
                var selectValue = $(this).val();

                if (selectValue == 'kantor') {
                    $('#formKantor').show(200);
                    $('#formLain').hide();
                    $('#pickup_loc').html('Kantor / Office');
                    $('#pickup_loc2').html('Kantor / Office');
                } else {
                    $('#formKantor').hide();
                    $('#formLain').show(200);
                    var otherLoc = $('#adress_pickup').val();
                    $('#dropff_loc').html('Other Location (' + otherLoc + ')');
                    $('#dropff_loc2').html('Other Location (' + otherLoc + ')');
                }
            });
            $('#pengembalian').change(function() {
                var selectValue = $(this).val();

                if (selectValue == 'kantor') {
                    $('#pengembalianKantor').show(200);
                    $('#pengembalianLuar').hide();
                    $('#dropoff_loc').html('Kantor / Office');
                    $('#dropoff_loc2').html('Kantor / Office');
                } else {
                    var otherLoc = $('#address_dropoff').val();
                    $('#pengembalianKantor').hide();
                    $('#pengembalianLuar').show(200);
                    $('#dropoff_loc').html('Other Location (' + otherLoc + ')');
                    $('#dropoff_loc2').html('Other Location (' + otherLoc + ')');
                }
            });

            $('#address_dropoff').keyup(function() {
                var otherLoc = $('#address_dropoff').val();
                $('#dropoff_loc').html('Other Location (' + otherLoc + ')');
                $('#dropoff_loc2').html('Other Location (' + otherLoc + ')');
            });
            $('#address_pickup').keyup(function() {
                var otherLoc = $('#address_pickup').val();
                $('#pickup_loc').html('Other Location (' + otherLoc + ')');
                $('#pickup_loc2').html('Other Location (' + otherLoc + ')');
            })

            $('#serviceInput').change(function() {
                var input = $('#serviceInput').val();
                if (input == 'with_driver') {
                    $('#service').html('With Driver');
                    $('#service2').html('With Driver');
                    $('#add_service').html('With Driver ( + '+ $('#driver_price').val() + ' )');
                } else {
                    $('#service').html('WithOut Driver');
                    $('#service2').html('WithOut Driver');
                }
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

            $('#rental_start,#rental_end,#rental_time_start,#rental_time_end').change(function(){
               ayoBerhitung(); 
            });
            $('#konfirm').click(function(){
                ayoBerhitung();
            });
        });
    </script>
@endsection
