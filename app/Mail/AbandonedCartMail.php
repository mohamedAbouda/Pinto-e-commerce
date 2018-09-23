<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbandonedCartMail extends Mailable
{
    use Queueable, SerializesModels;

    public $level = 'success';
    public $introLines = ['You abandoned this cart check it out :'];
    public $outroLines = [];
    public $cart;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.cart');
    }
}
