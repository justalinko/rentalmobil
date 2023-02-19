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

        $msg = "
NEW ORDER #{$event->booking_code}\n\n
Customer : {$event->name} ($event->email) ($event->phone)\n\n
------------------------------------------------------------\n
Rental Item : {$event->armada->brand} {$event->armada->name}
Duration    : {$event->start_date} {$event->start_time} / {$event->end_date} {$event->end_time} ( ".dooration($event->start_date,$event->end_date,$event->start_time,$event->end_time)." )\n
Payment Method : {$event->payment_method}\n
Status         : {$event->status}\n
Total Price    : {$event->total_price}\n
------------------------------------------------------------\n
# ACTIONS 
Confirm  : ".url('/api/order-actions/'.$event->booking_code.'?action=confirmed&secret='.sha1($event->booking_code))."\n
On Going : ".url('/api/order-actions/'.$event->booking_code.'?action=on_going&secret='.sha1($event->booking_code))."\n
Cancel   : ".url('/api/order-actions/'.$event->booking_code.'?action=cancelled&secret='.sha1($event->booking_code))."\n

Customer Type / Ordered by : {$event->customer_type} /  {$event->created_by}\n
";
        if(env('TELEGRAM_BOT_TOKEN') != null && env('TELEGRAM_CHAT_ID') != null){
        telegramMessage($msg);
        }

        if(env('WHATSAPP_ADMIN') != null)
        {
            easyWa(env('WHATSAPP_ADMIN') , $msg);
        }


        $notifyUserMessage = __("Dear :customer_name , Your rental order with booking ID :booking_code placed , for payment or about your status order details save your invoice link : :invoice_link \n\n **thank you for trusting ".web()->name, ['booking_code' => $event->booking_code , 'invoice_link' => url('/i/'.$event->booking_code) , 'customer_name' => $event->name ]);
        if($event->contact_type == 'telegram'){
            $phone = preg_replace("/^0/", "62", $event->phone);
            easyWa($phone, $notifyUserMessage);
        }else{
            $phone = preg_replace("/^0/", "62", $event->contact_id);
            easyWa($phone , $notifyUserMessage);
        }
        

    }
}
