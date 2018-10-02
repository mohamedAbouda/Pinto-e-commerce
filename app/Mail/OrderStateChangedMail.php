<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStateChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $level = 'success';
    public $introLines = ['Here is your invoice : '];
    public $outroLines = [];
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order , $message , $level)
    {
        $this->order = $order;
        $this->introLines = explode("\n", str_replace("\r", "", $message));
        switch ($level) {
            case 1: // default success
                break;
            case 2:
                $this->level = 'error';
                break;
            case 3:
                $this->level = '';
                break;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.email');
    }
}
