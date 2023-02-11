<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class ReportController extends Controller
{

    public function index()
    {
        $data['orders'] = Order::where('status','finished')->orderBy('id','desc')->get();
        $data['totalRental'] = Order::where('status','finished')->count();
        $data['totalIncome'] = Order::where('status','finished')->sum('total_price');
    return view('admin.reports',$data);
    }
    public function filterManager(Request $request)
    {
        $filter = $request->filter;
        if($filter == 'all' || $filter == null){
            return $this->all();
        }elseif($filter == 'monthly'){
            return $this->monthly($request);
        }elseif($filter == 'yearly'){
            return $this->yearly($request);
        }elseif($filter == 'daily'){
            return $this->daily($request);
        }
    }
    public function all()
    {
        $data['orders'] = Order::where('status','finished')->orderBy('id','desc')->get();
        $data['totalRental'] = Order::where('status','finished')->count();
        $data['totalIncome'] = Order::where('status','finished')->sum('total_price');
        return view('admin.reports',$data);
    }
    public function monthly(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $data['orders'] = Order::where('status','finished')->whereMonth('created_at',$month)->whereYear('created_at',$year)->orderBy('id','desc')->get();
        $data['totalRental'] = Order::where('status','finished')->whereMonth('created_at',$month)->whereYear('created_at',$year)->count();
        $data['totalIncome'] = Order::where('status','finished')->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('total_price');
        return view('admin.reports',$data);

    }
    public function yearly(Request $request)
    {
        $year = $request->year;
        $data['orders'] = Order::where('status','finished')->whereYear('created_at',$year)->orderBy('id','desc')->get();

        $data['totalRental'] = Order::where('status','finished')->whereYear('created_at',$year)->count();
        $data['totalIncome'] = Order::where('status','finished')->whereYear('created_at',$year)->sum('total_price');
        return view('admin.reports',$data);

    }
    public function daily(Request $request)
    {
        $date = $request->date;
        $data['orders'] = Order::where('status','finished')->whereDate('created_at',$date)->orderBy('id','desc')->get();
        $data['totalRental'] = Order::where('status','finished')->whereDate('created_at',$date)->count();
        $data['totalIncome'] = Order::where('status','finished')->whereDate('created_at',$date)->sum('total_price');
        return view('admin.reports',$data);
    }
    public function weekly(Request $request)
    {
        $week = $request->week;
        $data['orders'] = Order::where('status','finished')->whereBetween('created_at',[$week.'-01',$week.'-31'])->orderBy('id','desc')->get();
        $data['totalRental'] = Order::where('status','finished')->whereBetween('created_at',[$week.'-01',$week.'-31'])->count();
        $data['totalIncome'] = Order::where('status','finished')->whereBetween('created_at',[$week.'-01',$week.'-31'])->sum('total_price');
        return view('admin.reports',$data);

    }
    public function export(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $data['data'] = Order::where('status','finished')->whereBetween('created_at',[$startDate,$endDate])->orderBy('id','desc')->get();
        dd($data);

    }

}
