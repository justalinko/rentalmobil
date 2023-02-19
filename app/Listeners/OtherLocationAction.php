<?php

namespace App\Listeners;

use App\Events\OtherLocation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OtherLocationAction
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
     * @param  \App\Events\OtherLocation  $event
     * @return void
     */
    public function handle(OtherLocation $event)
    {
        $order = $event->order;
        $otherlocation = $event->otherlocation;
        $type = $event->type;

        if ($otherlocation == true) {
            $whangsaff = ($order->contact_type == 'telegram') ?  $order->phone : $order->contact_id;
            $telex = ($order->contact_type == 'telegram') ? $order->contact_id :'';
            if($telex == '')
            {
                $telexx = '';
            }else{
                $telexx = '( https://t.me/'.$telex.' )';
            }
            $msg = "
# Request Pickup / DropOff Other Location \n\n
Date         : " . $order->created_at . "\n\n

Booking ID   : " . $order->booking_code . "\n
Status       : " . $order->status . "\n
Invoice Link : " . url('/i/' . $order->booking_code) . " \n\n

Request Type : " . $type . "\n
Address Pickup : " . $order->pickup_address . "\n
Address DropOff : " . $order->dropoff_address . "\n
-------------------------------------------------\n\n
Chat Customer : https://wa.me/{$whangsaff}  $telexx
";
            if (env('WHATSAPP_ADMIN') != null) {
                easyWa(env('WHATSAPP_ADMIN'), $msg);
            }
        }
    }
}
