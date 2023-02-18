<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportController extends Controller
{
    public function order()
    {
        $filename = 'Order_'.date('d-m-Y').'.xlsx';
        $header = ['Booking Code (ID)' , 'Status' , 'Customer' , 'Rental Item' ,'Start Date','End Date', 'Duration','Payment Method', 'Total Price' , 'Created Date', 'Created By' , 'Customer Type', 'Contact'];
        $database = Order::all();
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator(auth()->user()->name)
                                    ->setLastModifiedBy(auth()->user()->name)
                                    ->setTitle('Order list '  . date('D,d/m/Y'))
                                    ->setSubject('Order list ' .date('D,d/m/Y'))
                                    ->setDescription('Export data vehicles list');


        $index = $spreadsheet->setActiveSheetIndex(0);
        $alpha = range('A','Z');
        foreach($header as $p=>$head)
        {
            $index->setCellValue($alpha[$p].'1', $head);
        }
        foreach($database as $i=>$dt)
        {
            if($i==0 || $i == 1){
                $i = 2;
            }
            $index->setCellValue('A'.$i , $dt->booking_code);
            $index->setCellValue('B'.$i,$dt->status);
            $index->setCellValue('C'.$i,$dt->name.' '.$dt->email . ' '.$dt->phone);
            $index->setCellValue('D'.$i,$dt->armada->brand . ' '.$dt->armada->name);
            $index->setCellValue('E'.$i,$dt->start_date . ' '.$dt->start_time);
            $index->setCellValue('F'.$i,$dt->end_date . ' '.$dt->end_time);
            $index->setCellValue('G'.$i,dooration($dt->start_date , $dt->end_date , $dt->start_time, $dt->end_time));
            $index->setCellValue('H'.$i,$dt->payment_method);
            $index->setCellValue('I'.$i,$dt->total_price);
            $index->setCellValue('J'.$i,$dt->created_at);
            $index->setCellValue('K'.$i,$dt->created_by);
            $index->setCellValue('L'.$i,$dt->customer_type);
            $index->setCellValue('M'.$i,$dt->contact_type . ' '.$dt->contact_id);

        }

       
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }


    public function vehicles()
    {
        $filename = 'Vehicles_'.date('d-m-Y').'.xlsx';
        $header = ['Tipe' , 'BrandName' , 'Seat' , 'Luggage' , 'Transmission','Fuel Type', 'Price/Hour' , 'Price/Day' , 'PriceOtherLocation(Pickup&Dropoff)' , 'Stock', 'Used' , 'Available'];
        $database = Armada::all();
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator(auth()->user()->name)
                                    ->setLastModifiedBy(auth()->user()->name)
                                    ->setTitle('Vehicles list '  . date('D,d/m/Y'))
                                    ->setSubject('Vehicles list ' .date('D,d/m/Y'))
                                    ->setDescription('Export data vehicles list');


        $index = $spreadsheet->setActiveSheetIndex(0);
        $alpha = range('A','Z');
        foreach($header as $p=>$head)
        {
            $index->setCellValue($alpha[$p].'1', $head);
        }
        foreach($database as $i=>$dt)
        {
            if($i==0 || $i == 1){
                $i = 2;
            }
            $index->setCellValue('A'.$i , $dt->type);
            $index->setCellValue('B'.$i,$dt->brand.' '.$dt->name);
            $index->setCellValue('C'.$i,$dt->seat);
            $index->setCellValue('D'.$i,$dt->luggage);
            $index->setCellValue('E'.$i,$dt->transmission);
            $index->setCellValue('F'.$i,$dt->fuel);
            $index->setCellValue('G'.$i,$dt->price_hour);
            $index->setCellValue('H'.$i,$dt->price_day);
            $index->setCellValue('I'.$i,$dt->price_otherlocation);
            $index->setCellValue('J'.$i,$dt->stock);
            $index->setCellValue('K'.$i,$dt->used);
            $index->setCellValue('L'.$i,$dt->stock - $dt->used);

        }

       
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function report(Request $request)
    {
        $filter = (empty($request->filter)) ? 'all' : $request->filter;
        $date = (empty($request->date)) ? date('d') : $request->date;
        $month = (empty($request->month)) ? date('m') : $request->month;
        $year = (empty($request->year)) ? date('Y') : $request->year;
        $filename = 'Report_'.$filter.'_'.date('d-m-Y').'.xlsx';

        $header = ['Booking Code (ID)' , 'Status' , 'Customer' , 'Rental Item' ,'Start Date','End Date', 'Duration','Payment Method', 'Total Price' , 'Created Date'];
        if($filter == 'all'){
             $database = Order::where('status' ,'finished')->orderBy('id','desc')->get();
        }elseif($filter == 'daily')
        {
            $database = Order::where('status','finished')->whereDay('created_at', $date)->orderBy('id','desc')->get();
        }elseif($filter == 'monthly')
        {
            $database = Order::where('status','finished')->whereMonth('created_at', $month)->orderBy('id','desc')->get();
        }elseif($filter == 'yearly')
        {
            $database = Order::where('status','finished')->whereYear('created_at', $year)->orderBy('id','desc')->get();
        }elseif($filter == 'custom')
        {
            $database = Order::where('status','finished')->whereBetween('created_at', [$request->start_date, $request->end_date])->get();
        }else{
            $database = Order::where('status','finished')->orderBy('id','desc')->get();
        }
        
       
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator(auth()->user()->name)
                                    ->setLastModifiedBy(auth()->user()->name)
                                    ->setTitle('Order reports list '  . date('D,d/m/Y'))
                                    ->setSubject('Order reports list ' .date('D,d/m/Y'))
                                    ->setDescription('Export data Order reports');


        $index = $spreadsheet->setActiveSheetIndex(0);
        $alpha = range('A','Z');
        foreach($header as $p=>$head)
        {
            $index->setCellValue($alpha[$p].'1', $head);
        }
        $countData = count($database);
        foreach($database as $i=>$dt)
        {
            if($i==0 || $i == 1){
                $i = 2;
            }
            $index->setCellValue('A'.$i , $dt->booking_code);
            $index->setCellValue('B'.$i,$dt->status);
            $index->setCellValue('C'.$i,$dt->name.' '.$dt->email . ' '.$dt->phone);
            $index->setCellValue('D'.$i,$dt->armada->brand . ' '.$dt->armada->name);
            $index->setCellValue('E'.$i,$dt->start_date . ' '.$dt->start_time);
            $index->setCellValue('F'.$i,$dt->end_date . ' '.$dt->end_time);
            $index->setCellValue('G'.$i,dooration($dt->start_date , $dt->end_date , $dt->start_time, $dt->end_time));
            $index->setCellValue('H'.$i,$dt->payment_method);
            $index->setCellValue('I'.$i,$dt->total_price);
            $index->setCellValue('J'.$i,$dt->created_at);

        }

        $index->setCellValue('G'.$countData+1 , 'TOTAL INCOME');
        $index->setCellValue('H'.$countData+1 , '=SUM(I2:I'.$countData.')');
        $index->setCellValue('G'.$countData+2 , 'TOTAL ORDER');
        $index->setCellValue('H'.$countData+2 , '=COUNTA(I2:I'.$countData.')');

       
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;        
    }

    public function addreport()
    {
        $header = ['Date' , 'Type' , 'Amount' , 'Description' , 'Added By'];
        $database = Report::orderBy('id','desc')->get();
        $filename = 'Additional_Report_'.date('d-m-Y').'.xlsx';
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator(auth()->user()->name)
                                    ->setLastModifiedBy(auth()->user()->name)
                                    ->setTitle('Order reports list '  . date('D,d/m/Y'))
                                    ->setSubject('Order reports list ' .date('D,d/m/Y'))
                                    ->setDescription('Export data Order reports');


        $index = $spreadsheet->setActiveSheetIndex(0);
        $alpha = range('A','Z');
        foreach($header as $p=>$head)
        {
            $index->setCellValue($alpha[$p].'1', $head);
        }
        $countData = count($database);
        foreach($database as $i=>$dt)
        {
            if($i==0 || $i == 1){
                $i = 2;
            }
            $index->setCellValue('A'.$i , $dt->date);
            $index->setCellValue('B'.$i,$dt->type);
            $index->setCellValue('C'.$i,$dt->amount);
            $index->setCellValue('D'.$i,$dt->description);
            $index->setCellValue('E'.$i,$dt->add_by);
           

        }

       
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;      
    }
    public function exportManager(Request $request)
    {
        $d = $request->d;
        if($d == 'vehicles')
        {
            return $this->vehicles();
        }elseif($d == 'order')
        {
            return $this->order();
        }elseif($d == 'report')
        {
            return $this->report($request);
        }elseif($d == 'addreport')
        {
            return $this->addreport($request);
        } else {
         return  redirect()->back()->with('error' , 'Export data not found');
        }
    }

  
}
