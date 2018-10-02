<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserDenyed extends Notification
{
    use Queueable;

    protected $reason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reason = NULL)
    {
        if ($reason) {
            $this->reason = $reason;
        }else{
            $this->reason = "'You've been denyed access to our website you can contact us for more info'";
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
        return (new MailMessage)
                    ->level('error')
                    ->line($this->reason)
                    ->action('Go to website', route('web.index'))
                    ->line('Thank you for using our application!');
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
