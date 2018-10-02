<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForgetPassword extends Notification
{
    use Queueable;

    protected $token;
    protected $is_merchant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token ,$is_merchant = false)
    {
        $this->token = $token;
        $this->is_merchant = $is_merchant;
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
                    ->greeting('Hello')
                    ->line('You\'ve requested a reset for your password.')
                    ->line('Please click the link if you really want to change your password ..')
                    ->action('Reset password', $this->is_merchant ? route('dashboard.merchant.auth.getResetPassword' , $this->token) : route('web.auth.getResetPassword' , $this->token))
                    ->line('Thank you for using our website.');
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
