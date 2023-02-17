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

<html>
    <head>
        <title></title>
    </head>
    <body>
        
        <main>
            <center>
                <h1>{{web()->name}}</h1>
                <p>{{web()->email}} | {{web()->address}} | {{url('/')}}</p>
            </center>
            <table border="1" style="border-collapse:collapse;width:100%;">
                
                <tr>
                    <td>
                        <b>{{web()->name}} </b>
                    </td>
                    <td>
                    <strong>Date:</strong> {{$order->created_at}}
                    </td>
                    <td> 
                    <strong>Booking ID :</strong> {{$order->booking_code}}
                    </td>
                </tr>
            </table>
            
            <hr>
            <table border="1" style="border-collapse: collapse;">
                <tr>
                    <td> <strong>Pay To:</strong></td>
                    <td><strong>Invoiced To:</strong></td>
                </tr>
                <tr>
                    <td>
                  <address>
                 {{web()->title}}<br>
                  {{web()->address}}<br>
                  {{web()->phone}}<br>
                  {{web()->email}}
                  </address>
                    </td>
                    <td>
          
                  <address>
                 {{$order->name}}<br>
                  {{$order->email}} ( {{$order->phone}})
                  </address>
                    </td>
                </tr>
            </table>
            
            <div class="card text-center">
                <div class="card-body p-0">
                  <div class="table-responsive table-bordered">
                    <table class="table mb-0" border=1 style="border-collapse: collapse;margin-top:30px;width:100%">
                    <thead class="card-header" style="background-color:red;color:white;padding:6px;">
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
                <b>Payment Method : {{$order->payment_method}} - {{\App\Models\PaymentMethod::where('name' , $order->payment_method)->first()->description}}</b>
                <p class="text-1"><strong>NOTE :</strong> {{__('pickup in other location must be approved by the admin first, the admin will confirm via your contact')}}</p>
              
            </footer>
        </main>
    </body>
</html>