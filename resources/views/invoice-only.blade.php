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

<div class="modal fade" id="infoStatus" tabindex="-1" aria-labelledby="infoStatus" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-3" id="infoStatusLabel">{{__('Information about your status')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body table-responsive">
          <table class="table">
            <thead>
                <th>STATUS</th>
                <th>{{__('DESCRIPTION')}}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {!!invoiceStatus('waiting_payment')!!}
                    </td>
                    <td>
                        {{__('Your order is waiting your payment confirmation')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('waiting_confirmation')!!}
                    </td>
                    <td>
                        {!!wordwrap(__('You was confirmed your payment, but admin still not confirmed your payment. Please wait for confirmation'),60,"<br>")!!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('confirmed')!!} / {!!invoiceStatus('waiting_pickup')!!}
                    </td>
                    <td>
                        {!!wordwrap(__('Your payment was confirmed by admin. You can pick up your order'),60,"<br>")!!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('cancelled')!!}
                    </td>
                    <td>
                        {{__('Your order was cancelled by admin')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('finished')!!}
                    </td>
                    <td>
                        {{__('Your order was finished')}}
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<section class="ftco-section bg-light pt-5 p-4">
    <div class="container bg-white rounded p-3 border">
        <header>
            <div class="row  pt-3">
                <div class="col-sm-6 text-center text-sm-left mb-3 mb-sm-0">
                    <h2 class="font-weight-bold">Rental <span class="text-danger">Mobil</span></h2>
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
                                <select name="payment_method" title="Select Payment Method" id="payment_method" class="form-control selectpicker">
                                    <option value="mandiri" data-thumbnail="/assets/images/mandiri.png">Transfer Bank Mandiri</option>
                                    <option value="bca" data-thumbnail="/assets/images/bca.png">Transfer Bank BCA</option>
                                    <option value="cash">Cash when PickUp</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">{{__('Confirm Payment')}}</button>
                              
                            </div>
                            </form>
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
                <p class="text-1"><strong>NOTE :</strong> Pesanan Akan Segera Di Proses Setelah Pembayaran Telah Selesai</p>
                <div class="btn-group btn-group-sm d-print-none">
                    <a href="javascript:window.print()" class="btn btn-info shadow-none mr-2"><i class="fa fa-print"></i> Print</a> 
                    <a href="/i/{{$order->booking_code}}?pdf=true" class="btn btn-success shadow-none"><i class="fa fa-download"></i> Download</a>
                </div>
            </footer>
        </main>
    </div>
</section>