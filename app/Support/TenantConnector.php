<?php

namespace App\Support;

use App\Models\Main\Tenant as TenantModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait TenantConnector {

    /**
    * Switch the Tenant connection to a different company.
    * @param Company $company
    * @return void
    * @throws
    */
    public function reconnect(TenantModel $company) {
        // Erase the tenant connection, thus making Laravel get the default values all over again.
        DB::purge('tenant');

        // Make sure to use the database name we want to establish a connection.
        if ($company->mysql_host) {
            Config::set('database.connections.tenant.host', $company->mysql_host);
        }
        if ($company->mysql_database) {
            Config::set('database.connections.tenant.database', $company->mysql_database);
        }
        if ($company->mysql_username) {
            Config::set('database.connections.tenant.username', $company->mysql_username);
        }
        if ($company->mysql_password) {
            Config::set('database.connections.tenant.password', $company->mysql_password);
        }

        // Rearrange the connection data
        DB::reconnect('tenant');

        // Ping the database. This will throw an exception in case the database does not exists or the connection fails
        Schema::connection('tenant')->getConnection()->reconnect();
    }
}
