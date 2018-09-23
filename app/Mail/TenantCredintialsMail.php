<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Main\Tenant;

class TenantCredintialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $level = 'success';
    public $introLines;
    public $actionText = 'Visit your website';
    public $actionUrl = '';
    public $outroLines = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tenant $tenant,$credentials)
    {
        $this->introLines = [
            'Thanks for signing up with Eshoppica.',
            'Your email : '.$credentials['email'],
            'Your password : '.$credentials['password'],
            'Note that these are basic credentials please change them as soon as possible.'
        ];
        $this->actionUrl = getBaseUrl($tenant->sub_domain).'/dashboard/login';
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
