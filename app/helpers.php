<?php

function rupiah($number)
{
    $p = str_replace("," , "." , number_format($number));
    return "Rp. ".$p;
}

function makeBookingCode()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $peler =  $randomString;
    $date = date('dmyHi');
    $booking_code = $date.$peler.'-'.rand(1,100);
    return strtoupper(substr(sha1($booking_code), 0, 10));
}

function totalPrice($basePrice ,$additional_service1 =0 , $additional_service2 = 0  , $additional_service3 = 0)
{
    $total = $basePrice + $additional_service1 + $additional_service2 + $additional_service3;
    return $total;
}

function invoiceStatus($status)
{
    if($status == 'waiting_payment')
    {
        $x = '<span class="badge bg-warning badge-warning"><i class="fa fa-spin fa-spinner"></i> Waiting Payment</span>';
    }elseif($status == 'waiting_confirmation')
    {
        $x = '<span class="badge bg-info badge-info"><i class="fa fa-spin fa-spinner"></i> Waiting Confirmation</span>';
    }elseif($status == 'waiting_pickup')
    {
        $x = '<span class="badge bg-info badge-info"><i class="fa fa-spin fa-spinner"></i> Waiting Pickup</span>';
    }elseif($status == 'confirmed')
    {
        $x = '<span class="badge bg-success badge-success"><i class="fa fa-check"></i> Confirmed</span>';
    }elseif($status == 'cancelled')
    {
        $x = '<span class="badge bg-danger badge-danger"><i class="fa fa-times"></i> Cancelled</span>';
    }elseif($status == 'finished')
    {
        $x = '<span class="badge bg-success badge-success"><i class="fa fa-check"></i> Finished</span>';
    }else{
        $x = '<span class="badge bg-danger badge-danger"><i class="fa fa-times"></i> Unknown</span>';
    }
    return $x;
}

function web()
{
    return \App\Models\Websetting::first();
}
function web_name()
{
    $name= web()->name;
    $split = substr($name, 0, 3);
    $split2 = substr($name, 3, strlen($name));
    return $split.'<span>'.$split2.'</span>';
}

function dooration($startDate,$endDate,$startTime,$endTime)
{
    $start1 = new \DateTime($startDate);
    $start1->format('Y-m-d');
    $end1 = new \DateTime($endDate);
    $end1->format('Y-m-d');
    $diffDay = $start1->diff($end1)->days;
    if($diffDay == 0)
    {
        $start2 = new \DateTime($startTime);
        $start2->format('H:i');
        $end2 = new \DateTime($endTime);
        $end2->format('H:i');
        $diffTime = $start2->diff($end2)->h;
        $diffTime = $diffTime + 1;
        return $diffTime . ' Hours';
    }
    return $diffDay. ' Days';
}

function monthHuman($number = null)
{
    $month = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];
    if($number == null)
    {
        return $month;
    }else{
        return $month[$number];
    }
}

function strPad2digit($number)
{
    return str_pad($number, 2, '0', STR_PAD_LEFT);
}

function exportCsv($data, $filename = 'export.csv', $delimiter = ',')
{
    $f = fopen('php://memory', 'w');
    foreach ($data as $line) {
        fputcsv($f, $line, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}