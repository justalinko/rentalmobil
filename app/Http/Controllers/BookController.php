<?php

namespace App\Http\Controllers;

use App\Events\BookConfirm;
use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function doBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'service_type' => 'required',
            'pickup_type' => 'required',
            'dropoff_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pickupType = ($request->pickup_type == 'kantor') ? 'office' : 'other_location';
        $dropoffType = ($request->dropoff_type == 'kantor') ? 'office' : 'other_location';
        $armada = Armada::find($request->id);
        /////////////////////////////////////////////////////////
        $startDateTime = new \DateTime($request->start_date);$startDateTime->format('Y-m-d');
        $endDateTime = new \DateTime($request->end_date); $endDateTime->format('Y-m-d');
        $duration = $startDateTime->diff($endDateTime)->days;

     
        /////////////////////////////////////////////////////////

        $addService1 = ($pickupType == 'other_location') ? $armada->price_otherlocation : 0;
        $addService2 = ($dropoffType == 'other_location') ? $armada->price_otherlocation : 0;
        $addService3 = ($request->service_type == 'with_driver') ? $armada->price_withdriver : 0;
        $totalPrice = totalPrice($armada->price_day * $duration,$addService1,$addService2,$addService3 );
        $durType = 'day';

        if($duration == 0){
            $durType = 'hour';
            $startTime = new \DateTime($request->start_time);$startTime->format('H:i');
            $endTime = new \DateTime($request->end_time);$endTime->format('H:i');
            $duration = $startTime->diff($endTime)->h;
            $addService1 = ($pickupType == 'other_location') ? $armada->price_otherlocation : 0;
            $addService2 = ($dropoffType == 'other_location') ? $armada->price_otherlocation : 0;
            $addService3 = ($request->service_type == 'with_driver') ? $armada->price_withdriver : 0;
            $totalPrice = totalPrice($armada->price_hour * $duration,$addService1,$addService2,$addService3 );
        }

        $bookong = makeBookingCode();
        $order = new Order();
        $order->armada_id = $request->id;
        $order->booking_code = $bookong;~
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->service_type = $request->service_type;
        $order->pickup_type = $pickupType;
        $order->dropoff_type =$dropoffType;
        $order->pickup_address = $request->pickup_address;
        $order->dropoff_adress = $request->dropoff_adress;
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->start_time = $request->start_time;
        $order->end_time = $request->end_time;
        $order->total_price = $totalPrice;
        $order->note = 'Order '.$armada->brand.' '.$armada->type.' for '.$duration.' '.$durType;
        $order->save();

        
        return redirect('/i/'.$bookong)->with('order',$order);
        
    }
    
    public function directBook(Request $request)
    {
        session()->put('direct' , json_encode($request->all()));
        return redirect('/vehicles');
    }

    public function invoice(Request $request)
    {

      //  BookConfirm::dispatch($request->code);
        if($request->pdf == true)
        {
            $order = Order::where('booking_code',$request->code)->first();
            $dompdf = new Dompdf();
            $data['order'] = $order;
            $html = view('invoice',$data)->render();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($order->email."_#".$order->booking_code.".pdf", array("Attachment" => false));

        }else{
        $data['order'] = Order::where('booking_code',$request->code)->first();
        return view('invoice',$data);
        }
    }

    public function confirm(Request $request)
    {
        $data['order'] = Order::where('booking_code',$request->code)->first();
        return view('confirm',$data);
    }

    public function confirmPost(Request $request)
    {
        $order = Order::where('booking_code',$request->code)->first();
        $order->status = 'waiting_confirmation';
        $order->payment_method = $request->payment_method;
        $order->note = '['.$request->code.']  Order '.$order->armada->brand.' '.$order->armada->type.' for '.$order->duration.' '.$order->duration_type.' with '.$request->payment_method.' payment method ';
        $order->save();
        
        $armada = Armada::find($order->armada_id);
        $armada->stock = $armada->stock - 1;
        $armada->save();

        BookConfirm::dispatch($request->code);
        return redirect('/i/'.$request->code);
    }

    public function Check(Request $request)
    {
        $ada = Order::where('booking_code',$request->code)->count();
        if($ada > 0){
            return redirect('/i/'.$request->code);
        }else{
            return redirect('/booking-check')->with('error','Booking Code Not Found');
        }
    }

}
