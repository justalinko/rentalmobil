<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('admin.general');
    }

    public function login()
    {
        return view('admin.login');
    }
}
