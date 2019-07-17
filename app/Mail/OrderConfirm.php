<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use App\User;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sale_id;
    public function __construct($sale_id)
    {
        $this->sale_id = $sale_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sale_id = $this->sale_id;
        $user_id = Order::where('id', $sale_id)->first()->user_id;
        $user_email = User::where('id', $user_id)->first()->email;
        return $this->from('mohasin2911@gmail.com')
                    ->to($user_email)
                    ->view('mail.orderConfirm', compact('sale_id'));
    }
}
