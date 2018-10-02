<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Discount;
use Carbon\Carbon;
use App\Support\TenantConnector;
use App\Models\Main\Tenant as TenantModel;

class DiscountsActivationWatchdog extends Command
{
    use TenantConnector;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discounts:watchdog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set discounts active state as 0';

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
        $carbon = new Carbon();
        $now = $carbon->now()->toDateTimeString();

        $companies = TenantModel::get();
        foreach ($companies as $company) {
            $this->reconnect($company);
            Discount::where('active' , 1)
            ->where('activation_start' , '<' , $now)
            ->where('activation_end' , '<=' , $now)->update(['active' => 0]);
        }
    }
}
