<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
use App\Mail\AbandonedCartMail;
use Carbon\Carbon;
use Mail;
use App\Support\TenantConnector;
use App\Models\Main\Tenant as TenantModel;

class SendAbandonedCarts extends Command
{
    use TenantConnector;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:abandonedCarts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for abandoned carts and send them to the user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $companies = TenantModel::get();
        foreach ($companies as $company) {
            $this->reconnect($company);
            $carts = Cart::where('seen' , 0)->get();
            foreach ($carts as $cart) {
                $then = Carbon::parse($cart->created_at);
                $diff = $now->diffInMinutes($then);
                if ($diff > config('session.lifetime')) {
                    Mail::to($cart->user->email)->send(new AbandonedCartMail($cart));
                    $cart->seen = 1;
                    $cart->save();
                }
            }
        }
    }
}
