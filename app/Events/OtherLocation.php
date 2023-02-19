<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OtherLocation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $otherlocation;
    public $type;
    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($booking_code)
    {
        $order = Order::where('booking_code' , $booking_code)->first();
        if($order)
        {
            if($order->pickup_type == 'other_location' && $order->dropoff_type == 'office')
            {
                $this->otherlocation = true;
                $this->type = 'pickup';
                $this->order = $order;
            }elseif($order->dropoff_type == 'other_location' && $order->pickup_type == 'office')
            {
                $this->otherlocation = true;
                $this->type = 'dropoff';
                $this->order = $order;
            }elseif($order->pickup_type == 'other_location' && $order->dropoff_type == 'other_location')

            {
                $this->otherlocation = true;
                $this->type = 'pickup_dropoff';
                $this->order = $order;
            }else{
                $this->otherlocation = false;
                $this->type = '';
                $this->order ='';
            }

        }else{
            $this->otherlocation = false;
                $this->type = '';
                $this->order = '';
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('otherlocation');
    }
}
