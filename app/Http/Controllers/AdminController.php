<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data['orders'] = \App\Models\Order::orderBy('id' , 'desc')->limit(10)->get();
        $data['totalIncome'] = \App\Models\Order::where('status','finished')->sum('total_price');
        $data['totalRental'] = \App\Models\Order::where('status','finished')->count();
        $data['totalIncomeWeek'] = \App\Models\Order::where('status','finished')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_price');
        $data['totalRentalWeek'] = \App\Models\Order::where('status','finished')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        return view('admin.dashboard',$data);
    }

    public function orders()
    {
        return view('admin.orders_admin');
    }

    public function vehicles()
    {
        return view('admin.vehicles_admin');
    }

    public function general()
    {
        $data['edit'] = web();
        return view('admin.general',$data);
    }

    public function generalUpdate(Request $request)
    {
        $tr = \App\Models\Websetting::truncate();

        $web =new \App\Models\Websetting;
        if($request->hasFile('icon'))
        {
            $icon = $request->file('icon');
            $name = time().$icon->getClientOriginalName();
            $icon->move(public_path().'/assets/images/',$name);
            $web->icon = url('assets/images/'.$name);
        }else{
            $web->icon = fake('id')->imageUrl(50,50,'transport');
        }
       
        $web->title = $request->title;
        $web->meta_author = $request->meta_author;
        $web->meta_description = $request->meta_description;
        $web->meta_keywords = $request->meta_keywords;
        $web->terms = $request->terms;
        $web->privacy_policy = $request->privacy_policy;
        $web->about = $request->about;
        $web->gmaps_url = $request->gmaps_url;
        $web->name = $request->name;
        $web->email = $request->email;
        $web->phone = $request->phone;
        $web->address = $request->address;
        $web->office_phone = $request->office_phone;
        $web->fb_url = $request->fb_url;
        $web->ig_url = $request->ig_url;
        $web->tiktok_url = $request->tiktok_url;        
        $web->save();

        return redirect('/admin/general')->with('success','General setting has been updated');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function payment()
    {
        $data['payments'] = \App\Models\PaymentMethod::all();
        return view('admin.payments',$data);
    }

    public function payment_create()
    {
        $data['isEdit'] = false;
        $data['edit'] = null;
        return view('admin.form.payment' , $data);
    }
    public function payment_store(Request $request)
    {
        $payment = new \App\Models\PaymentMethod;
        $payment->name = $request->name;
        $payment->description = $request->description;
        $payment->status = $request->status;
        $payment->primary = $request->primary;
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/assets/images/',$name);
            $payment->icon = url('assets/images/'.$name);
        }else{
            $payment->icon = url('assets/images/default-payment.png');
        }
        $payment->save();

        return redirect('/admin/payments')->with('success','Payment method has been added');
    }

    public function payment_destroy($id)
    {
        $payment = \App\Models\PaymentMethod::find($id);
        $payment->delete();
        return redirect('/admin/payments')->with('success','Payment method has been deleted');
    }

    public function profile()
    {
        $data['profile'] = auth()->user();
        return view('admin.form.profile' , $data);
    }

    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;

        $user = \App\Models\User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/admin/profile')->with('success','Profile has been updated');
    }
}
