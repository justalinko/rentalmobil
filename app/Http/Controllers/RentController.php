<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function calculatePriceApi(Request $request)
    {
        $type = $request->type;
        $duration = $request->duration;
        $pid = $request->pid;
        $dropoff = $request->dropoff;
        $pickup = $request->pickup;
        $driver = $request->driver;
        $armada = Armada::find($pid);
        if($type == 'hour')
        {

            $data['base'] = $armada->price_hour;
            $data['dropoff'] = ($dropoff == 1 ) ? $armada->price_otherlocation : 0;
            $data['pickup'] = ($pickup == 1 ) ? $armada->price_otherlocation : 0;
            $data['driver'] = ($driver == 1 ) ? $armada->price_withdriver : 0;
            $data['driver_human'] = rupiah($data['driver']);
            $data['total'] = ($data['base'] * $duration + ($data['dropoff'] + $data['pickup'] + $data['driver']));
            $data['pickup_human'] = rupiah($data['pickup']);
            $data['dropoff_human'] = rupiah($data['dropoff']);
            $data['base_human'] = rupiah($data['base']);
            
            $data['total_human'] = rupiah($data['total']);
         
        }elseif($type == 'day')
        {
            $data['base'] = $armada->price_day;
            $data['dropoff'] = ($dropoff == 1 ) ? $armada->price_otherlocation : 0;
            $data['pickup'] = ($pickup == 1 ) ? $armada->price_otherlocation : 0;
            $data['driver'] = ($driver == 1 ) ? $armada->price_withdriver : 0;
            $data['driver_human'] = rupiah($data['driver']);
            $data['total'] = ($data['base'] * $duration + ($data['dropoff'] + $data['pickup'] + $data['driver']));
            $data['pickup_human'] = rupiah($data['pickup']);
            $data['dropoff_human'] = rupiah($data['dropoff']);
            $data['base_human'] = rupiah($data['base']);
            $data['total_human'] = rupiah($data['total']);

        }else{

        }
        return response()->json($data,200,[],JSON_PRETTY_PRINT);
        exit;
    }
}
