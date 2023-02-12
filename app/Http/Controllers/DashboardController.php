<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Websetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{

    public function index()
    {
        $data['armadas'] = Armada::paginate(9);
        return view('index',$data);
    }

    public function booking(Request $request)
    {
        $data['isDirect'] = (session()->has('direct')) ? true : false;
        $data['direct'] = json_decode(session()->get('direct'));
        $data['book'] = Armada::find($request->id);
    
        return view('booking',$data);
    }

    public function about()
    {
        $data['about'] = Websetting::all()[0]->about;
        return view('about',$data);
    }

    public function terms()
    {
        $data['terms'] = Websetting::all()[0]->terms;
        return view('terms', $data);
    }

    public function privacy_policy()
    {
        $data['privacy_policy'] = Websetting::all()[0]->privacy_policy;
        return view('privacy-policy', $data);
    }

    public function booking_check()
    {
        return view('booking-check');
    }

    public function contact()
    {
        $data['contact'] = Websetting::all()[0];
        return view('contact', $data);
    }

    public function vehicles(Request $request)
    {
        if($request->has('t'))
        {
            if($request->t == 'car')
            {
                $aremadaFilter = Armada::where('type',$request->t);
                if(!empty($request->seat))
                {
                    $aremadaFilter->where('seat',$request->seat);
                    //exit('gk kosong' . $request->seat);
                }
                if(!empty($request->transmission ))
                {
                    $aremadaFilter->where('transmission',$request->transmission);
                }
                if(!empty($request->fuel))
                {
                    $aremadaFilter->where('fuel', $request->fuel);
                }
                if(!empty($request->luggage))
                {
                    $aremadaFilter->where('luggage',$request->luggage);
                }
                $data['armadas'] = $aremadaFilter->paginate(8);
                return view('vehicles',$data);

            }elseif($request->t == 'all')
            {
            $data['armadas'] = Armada::paginate(8);
            return view('vehicles',$data);
            }elseif($request->t == 'motorcycle')
            {
                $data['armadas'] = Armada::where('type',$request->t)->paginate(8);
                return view('vehicles',$data);
            }
            
        }elseif($request->has('search')){
            $data['armadas'] = Armada::where('name','like','%'.$request->search.'%')->paginate(8);
            return view('vehicles',$data);
        }else{
            $data['armadas'] = Armada::paginate(8);
            return view('vehicles',$data);
        }
       
    }

    public function detail(Request $request)
    {
        $data['detail'] = Armada::find($request->id);
        return view('details',$data);
    }

    public function switchLang(Request $request)
    {
        $lang= $request->lang;
        session()->put('applocale',$lang);
        App::setlocale($lang);
        return redirect()->back();
    }
}
