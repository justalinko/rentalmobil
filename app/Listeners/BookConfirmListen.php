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
            'Link pembatalan' => url('/confirmed/'.$event->booking_code .'?signature='. sha1($event->booking_code).'&action=cancelled'),
            'Link'

        ];
        $msg = "";
        foreach ($data as $key => $value) {
            $msg .= str_replace('_',' ' , strtoupper($key)) . " : " . str_replace('_',' ',$value) . "\n";
        }
        
        telegramMessage($msg);


        $notifyUserMessage = __("Dear :customer_name , Your rental order with booking ID :booking_code placed , for payment or about your status order details save your invoice link : :invoice_link ", ['booking_code' => $event->booking_code , 'invoice_link' => url('/i/'.$event->booking_code) , 'customer_name' => $event->name ]);

     //   easyWa($event->phone, $notifyUserMessage);
        

    }
}
