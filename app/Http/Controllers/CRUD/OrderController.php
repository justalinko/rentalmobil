<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['orders'] = \App\Models\Order::orderBy('id','desc')->get();
 

        return view('admin.orders',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['isEdit'] = false;
        $data['edit'] = null;
        return view('admin.form.order',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book0ng = makeBookingCode();
        $order = new \App\Models\Order;
        $order->armada_id = $request->vehicles;
        $order->booking_code = $book0ng;
        $order->customer_type = $request->customer_type;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->contact_type = $request->contact_type;
        $order->contact_id = ($request?->contact_id) ? $request->contact_id : $request->phone;
        $order->service_type = $request->services_type;
        $order->pickup_type = $request->pickup_type;
        $order->pickup_address = $request->pickup_address;
        $order->dropoff_type = $request->dropoff_type;
        $order->dropoff_adress = $request->dropoff_adress;
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->start_time = $request->start_time;
        $order->end_time = $request->end_time;
        $order->total_price = $request->total_price;
        $order->note = 'Order created by admin';
        $order->payment_method = $request->payment_method;
        $order->status = $request->status;
        $order->additional_input = json_encode($request->addForm,JSON_PRETTY_PRINT);
        $order->created_by = auth()->user()->name;
        $order->save();

        return redirect('/admin/orders')->with('success' , 'Order created successfully')->with('order_success' , 'Order success with booking code : '.$order->booking_code.' <a href="/i/'.$order->booking_code.'" target="_blank">Click here to see invoice</a>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data['isEdit'] = true;
        $data['edit'] = \App\Models\Order::find($id);
        return view('admin.form.order',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = \App\Models\Order::find($id);
        $order->armada_id = $request->vehicles;
        $order->customer_type = $request->customer_type;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->contact_type = $request->contact_type;
        $order->contact_id = ($request?->contact_id) ? $request->contact_id : $request->phone;
        $order->service_type = $request->services_type;
        $order->pickup_type = $request->pickup_type;
        $order->pickup_address = $request->pickup_address;
        $order->dropoff_type = $request->dropoff_type;
        $order->dropoff_adress = $request->dropoff_adress;
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->start_time = $request->start_time;
        $order->end_time = $request->end_time;
        $order->total_price = $request->total_price;
        $order->note = 'Order updated by admin';
        $order->payment_method = $request->payment_method;
        $order->status = $request->status;
        $order->additional_input = json_encode($request->addForm,JSON_PRETTY_PRINT);
        $order->created_by = auth()->user()->name;
        $order->save();

        return redirect('/admin/orders')->with('success' , 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $to = $request->to;
        $id = $request->id;
        $order = \App\Models\Order::find($id);
        $order->status = $to;
        $order->note = 'Your status order updated to : ' .$to.' by admin';
        $order->save();

        $armada = \App\Models\Armada::find($order->armada_id);
        if($to == 'finished')
        {
            $armada->used = $armada->used - 1;
            $armada->save();
        }elseif($to == 'on_going')
        {
            $armada->used = $armada->used + 1;
            $armada->save();
        }
        
        return redirect('/admin/orders')->with('success','Status order updated to : '.$to);
    }
}
