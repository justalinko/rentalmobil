<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\Order;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['armadas'] = \App\Models\Armada::orderBy('id','desc')->get();
        return view('admin.vehicles',$data);
    }
    public function indexCheck(Request $request)
    {
        if($request->has('from_date') && $request->has('to_date') && $request->has('vehicles'))
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $armadaId = $request->vehicles;
            $data['armadas'] = Order::where('armada_id',$armadaId)->whereBetween('start_date',[$fromDate,$toDate])->get();
            return view('admin.vehicles-check',$data);
        }else{
        $data['armadas'] = \App\Models\Armada::all();
        return view('admin.vehicles-check',$data);
        }
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
        return view('admin.form.vehicle',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $armada = new \App\Models\Armada;
        if($request->hasFile('thumbnail'))
        {
            $file = $request->file('thumbnail');
            $filename = 'thumbnail_'.time()."_".$file->getClientOriginalName();
            $file->move(public_path('assets/images/thumb'),$filename);
           $armada->thumbnail = url('assets/images/thumb/'.$filename);
        }else{
            $armada->thumbnail = url('assets/images/default.jpg');
        }
        if($request->hasFile('images'))
        {
            $images = [];
            foreach($request->file('images') as $file)
            {
                $filename = 'images_'.time()."_".$file->getClientOriginalName();
                $file->move(public_path('assets/images/preview'),$filename);
                $images[] = url('assets/images/preview/'.$filename);
            }
            $images = json_encode($images);
            $armada->images = $images;
        }else{
            $images = json_encode([url('assets/images/default.jpg')]);
            $armada->images = $images;
        }

        $armada->name = $request->name;
        $armada->brand = $request->brand;
        $armada->type = $request->type;
        $armada->price_hour = $request->price_hour;
        $armada->price_day = $request->price_day;
        $armada->price_otherlocation = $request->price_otherlocation;
        $armada->price_withdriver = $request->price_withdriver;
        $armada->fuel = $request->fuel;
        $armada->luggage = $request->luggage;
        $armada->seat = $request->seat;
        $armada->description = $request->description;
        $armada->stock = $request->stock;
        $armada->save();

        return redirect()->back()->with('success','berhasil ditambahkan');
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
    public function edit($id)
    {
        $data['isEdit'] = true;
        $data['edit'] = \App\Models\Armada::find($id);
        return view('admin.form.vehicle',$data);
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
        $armada = Armada::find($id);
        if($request->hasFile('thumbnail'))
        {
            $file = $request->file('thumbnail');
            $filename = 'thumbnail_'.time()."_".$file->getClientOriginalName();
            $file->move(public_path('assets/images/thumb'),$filename);
           $armada->thumbnail = url('assets/images/thumb/'.$filename);
        }
        if($request->hasFile('images'))
        {
            $images = [];
            foreach($request->file('images') as $file)
            {
                $filename = 'images_'.time()."_".$file->getClientOriginalName();
                $file->move(public_path('assets/images/preview'),$filename);
                $images[] = url('assets/images/preview/'.$filename);
            }
            $images = json_encode($images);
            $armada->images = $images;
        }

        $armada->name = $request->name;
        $armada->brand = $request->brand;
        $armada->type = $request->type;
        $armada->price_hour = $request->price_hour;
        $armada->price_day = $request->price_day;
        $armada->price_otherlocation = $request->price_otherlocation;
        $armada->price_withdriver = $request->price_withdriver;
        $armada->fuel = $request->fuel;
        $armada->luggage = $request->luggage;
        $armada->seat = $request->seat;
        $armada->description = $request->description;
        $armada->stock = $request->stock;
        $armada->save();

        return redirect()->back()->with('success','berhasil di ubah');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $armada = \App\Models\Armada::find($id);
        $armada->delete();
        return redirect()->back()->with('success','berhasil dihapus');
    }
}
