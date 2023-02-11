<?php

namespace App\Listeners;

use App\Events\BookConfirm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookConfirmListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BookConfirm  $event
     * @return void
     */
    public function handle(BookConfirm $event)
    {
        $event = $event->order;
        $data = [
            'booking_code' => $event->booking_code,
            'nama' => $event->name,
            'email' => $event->email,
            'phone' => $event->phone,
            
            'Kendaraan yang di rental ' => $event->armada->brand . ' - '.$event->armada->name,

            'tanggal ambil (start)' => $event->start_date,
            'tanggal antar (end)' => $event->end_date,
            
            'total' => $event->total_price,
            'status' => $event->status,

            'Link konfirmasi pembayaran sukses' => url('/confirmed/'.$event->booking_code .'?signature='. sha1($event->booking_code).'&action=confirmed'),
            'Link pembatalan' => url('/confirmed/'.$event->booking_code .'?signature='. sha1($event->booking_code).'&action=cancelled')

        ];
        $msg = "";
        foreach ($data as $key => $value) {
            $msg .= str_replace('_',' ' , strtoupper($key)) . " : " . str_replace('_',' ',$value) . "\n";
        }
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendMessage",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "chat_id=".env('TELEGRAM_CHAT_ID')."&text=".$msg,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            file_put_contents(storage_path('logs/telegram.log'), $response."\n\n", FILE_APPEND);
            return $response;
        }

    }
}
