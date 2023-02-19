@php 
$start = new DateTime($order->start_date);
$end = new DateTime($order->end_date);
$diff = $start->diff($end);
$type = __('day');
$tipe = 'day';
if($diff->days == 0){
    $timeStart = new DateTime($order->start_time);
    $timeEnd = new DateTime($order->end_time);
    $diff = $timeStart->diff($timeEnd);
    $days = $diff->h;
    $type = __('hour');
    $tipe = 'hour';
}
$days = $diff->days;
@endphp



<section class="ftco-section bg-light pt-5 p-4">
    <div class="container bg-white rounded p-3 border">
        <header>
            <div class="row  pt-3">
                <div class="col-sm-6 text-center text-sm-left mb-3 mb-sm-0">
                    <h2 class="font-weight-bold">{!!web_name()!!} </h2>
                    <label>Booking ID <span class="font-weight-bold">#{{$order->booking_code}}</span></label>
                  <h4 class="font-weight-bold">STATUS : {!!invoiceStatus($order->status)!!} <span class="btn btn-info rounded-circle" data-toggle="modal" data-target="#infoStatus"><i class="fa fa-question"></i> </span></h4>
                </div>
                @if($order->status == 'waiting_payment')
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header text-center pb-0">
                            <p>{{__('Please Choose Your Preferred Method Of Payment')}}</p>
                        </div>
                        <div class="card-body">
                            <h6 class="text-center font-weight-bold">Manual Payment</h6>
                            <form method="POST" action="/confirm/{{$order->booking_code}}">
                                @csrf
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select name="payment_method" onchange="paymentMethodChange()" title="Select Payment Method" id="payment_method" class="form-control selectpicker">
                                        <option value="">Select Payment Method</option>
                                    @foreach(\App\Models\PaymentMethod::where('status','active')->get() as $metot)
                                            <option value="{{$metot->name}}" data-id="metot_{{$metot->id}}" @if($metot->primary == 1) selected @endif>{{$metot->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center mt-2" id="metotArea">

                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">{{__('Confirm Payment')}}</button>
                              
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header text-center pb-0">
                            <p>Payment Method</p>
                        </div>
                        <div class="card-body text-center">
                            @php $pm = \App\Models\PaymentMethod::where('name',$order->payment_method)->first(); @endphp
                            <img src="{{$pm->icon}}" class="img-fluid" style="max-width: 130px;height:auto;">
                            <h6 class="text-center font-weight-bold">{{$order->payment_method}}</h6>
                                <p>
                                    {{$pm->description}}
                                </p>
                        </div>

                        <div class="card-footer">
                            <p class="text-center mt-1">ORDER NOTE</p>
                            <p class="text-center mt-1">{{$order->note}}</p>
                        </div>
                    </div>
                </div>

                @endif
            </div>
            <hr>
        </header>
        
        <main>
            <div class="row">
                <div class="col-sm-7">
                    <strong>Date:</strong> {{$order->created_at}}
                </div>
                <div class="col-sm-5 text-sm-right"> 
                    <strong>Booking ID :</strong> {{$order->booking_code}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 text-sm-right order-sm-1"> <strong>Pay To:</strong>
                  <address>
                 {{web()->title}}<br>
                  {{web()->address}}<br>
                  {{web()->phone}}<br>
                  {{web()->email}}
                  </address>
                </div>
                <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                  <address>
                 {{$order->name}}<br>
                  {{$order->email}} ( {{$order->phone}})
                  </address>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body p-0">
                  <div class="table-responsive table-bordered">
                    <table class="table mb-0">
                    <thead class="card-header">
                      <tr>
                        <td class="col-3"><strong>Item Product</strong></td>
                        <td class="col-1 text-center"><strong>Service</strong></td>
                        <td class="col-3 text-center"><strong>Amount</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td class="col-3">{{$order->armada->brand}} - {{$order->armada->name}}</td>
                          <td class="col-4 text-1">
                            Transmission {{$order->armada->transmission}} <br>
                            {{__($order->service_type)}} <br>
                          </td>
                          <td class="col-2 text-center">
                            @if($tipe == 'day')
                            {{rupiah($order->armada->price_day)}}/{{$type}} <br>
                            @else
                            {{rupiah($order->armada->price_hour)}}/{{$type}} <br>
                            @endif
                            <small> 
                                @if($order->service_type == 'with_driver')
                                    {{rupiah($order->armada->price_withdriver)}} + {{__('driver')}}
                                @else
                                    {{rupiah(0)}}
                                @endif
                            </small>
                          </td>
                        </tr>
                        <tr>
                            <td class="col-3">Pick-up Location</td>
                            <td class="col-4 text-1">
                                {{__($order->pickup_type)}}
                                <br>
                                <small> 
                                    @if($order->pickup_address == null && $order->pickup_type == 'office')
                                        <a href="/contact" class="text-info">{{__('office address')}}</a>
                                    @else
                                        {{$order->pickup_address}}
                                    @endif
                                </small>
                            </td>
                            <td class="col-2 text-center">

                                @if($order->pickup_type == 'other_location' )
                                {{rupiah($order->armada->price_otherlocation)}}
                                @else
                                {{rupiah(0)}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="col-3">Drop-Off Location</td>
                            <td class="col-4 text-1">
                                {{__($order->dropoff_type)}}
                                <br>
                                <small> 
                                    @if($order->dropoff_address == null && $order->dropoff_type == 'office')
                                        <a href="/contact" class="text-info">{{__('office address')}}</a>
                                    @else
                                        {{$order->dropoff_address}}
                                    @endif
                                </small>
                            </td>
                            <td class="col-2 text-center">
                                @if($order->dropoff_type == 'other_location')
                                {{rupiah($order->armada->price_otherlocation)}}
                                @else
                                {{rupiah(0)}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="col-3">Rental Duration</td>
                            <td class="col-4 text-1">
                                {{$order->start_date}} {{$order->start_time}} / {{$order->end_date}} {{$order->end_time}} 
                          
                                <br>
                                {{$days}} {{$type}}(s)

                            </td>
                            <td class="col-2 text-center">
                                @if($tipe == 'day')
                                {{rupiah($order->armada->price_day * $days)}} <br>
                                @else
                                {{rupiah($order->armada->price_hour * $days)}} <br>
                                @endif
                            </td>
                        </tr>
                        @if($order?->additional_input && $order->additional_input != 'null')
                        @foreach(json_decode($order->additional_input) as $key => $value)
                            <tr>
                                <td>Additional </td>
                                <td>{{$key}}</td>
                                <td>{{rupiah($value)}}</td>
                            </tr>                        
                        @endforeach
                        @endif
                      </tbody>
                      <tfoot class="card-footer">
                        <tr>
                          <td colspan="2" class="text-right"><strong>Sub Total:</strong></td>
                          <td class="text-center">{{rupiah($order->total_price)}}</td>
                        </tr>
                        {{-- <tr>
                          <td colspan="2" class="text-right"><strong>Pajak / Tax:</strong><br>(PPN 11%)</td>
                          <td class="text-center">{{rupiah($order->total_price * 0.11 )}}</td>
                        </tr> --}}
                        <tr>
                          <td colspan="2" class="text-right border-bottom-0"><strong>Total:</strong></td>
                          <td class="text-center border-bottom-0">{{rupiah($order->total_price)}}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
            </div>
            <footer class="text-center mt-4">
                <p class="text-1"><strong>NOTE :</strong> {{__('pickup in other location must be approved by the admin first, the admin will confirm via your contact')}}</p>
                <div class="btn-group btn-group-sm d-print-none">
                    <a href="javascript:window.print()" class="btn btn-info shadow-none mr-2"><i class="fa fa-print"></i> Print</a> 
                    <a href="/i/{{$order->booking_code}}?pdf=true" class="btn btn-success shadow-none"><i class="fa fa-download"></i> Download</a>
                </div>
            </footer>
        </main>
    </div>
</section>
