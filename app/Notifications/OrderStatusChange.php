<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusChange extends Notification
{
    use Queueable;

    protected $status;

    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($status)
    {
        switch ($status) {
            case 1:
            $this->status = "Your order's been submitted waiting for confirmation.";
            break;
            case 2:
            $this->status = "Your order's been confrimed waiting for processing.";
            break;
            case 3:
            $this->status = "Your order's been cancelled contact the merchant for more info.";
            break;
            case 4:
            $this->status = "Your order's now in progress.";
            break;
            case 5:
            $this->status = "Your order's now being processed waiting for delivery.";
            break;
            case 6:
            $this->status = "Your order's been delivered.";
            break;
            case 7:
            $this->status = "Thanks for taking part in reviewing your order.";
            break;
            default:
        }
    }

    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
    * Get the mail representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
    public function toMail($notifiable)
    {
        if ($this->status) {
            return (new MailMessage)
            ->greeting('Hello')
            ->line($this->status)
            ->line('Thanks for using our website.');
        }
        abort(500);
    }

    /**
    * Get the array representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
