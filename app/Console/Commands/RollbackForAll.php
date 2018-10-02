<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Main\Tenant as TenantModel;
use App\Support\TenantConnector;
use Illuminate\Support\Facades\Artisan;

class RollbackForAll extends Command
{
    use TenantConnector;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollback:tenants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback migration for all tenants';

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
        $companies = TenantModel::get();
        foreach ($companies as $company) {
            $this->reconnect($company);
            Artisan::call('migrate:rollback', ['--database' => 'tenant']);
        }
    }
}
