<?php

namespace App\Support;

use App\Models\Main\Tenant as TenantModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Config;

class TenantBuilder {
    protected $database_name;
    protected $email;
    protected $password;

    function __construct($email ,$db = NULL)
    {
        if (!$db) {
            $name = $this->generateDatabaseName();
            $this->setDatabaseName($name);
        }else{
            $this->database_name = $db;
        }
        $this->password = str_random(9);
        $this->email = $email;
    }

    public function build()
    {
        $this->create($this->database_name);
        $this->migrate($this->database_name);
        return TRUE;
    }

    public function create($schema_name)
    {
        $username = Config::get('database.connections.tenant.username');
        $host = Config::get('database.connections.tenant.host');

        DB::statement("CREATE DATABASE {$schema_name}");
        // DB::statement("GRANT ALL PRIVILEGES ON {$schema_name}.* TO '{$username}'@'localhost' WITH GRANT OPTION");
        // DB::statement("FLUSH PRIVILEGES");
    }

    public function migrate($database_connection = 'tenant')
    {
        Config::set('database.connections.tenant.database', $database_connection);
        Artisan::call('migrate', ['--database' => 'tenant' , '--seed' => true]);
        DB::connection('tenant')->table('users')->insert([
            'name' => 'The Admin',
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone' => 123456,
            'company' => '',
            'address' => '',
            'country_id' => 1,
            'valid' => 1
        ]);
        // Artisan::call('db:seed', ['--database' => 'tenant']);
    }

    public function getDatabaseName()
    {
        return $this->database_name;
    }

    public function setDatabaseName($name)
    {
        $this->database_name = $name;
        return $this->database_name;
    }

    public function getCredentials()
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    public function generateDatabaseName()
    {
        $name = 'eshoppica_'.str_random('16');
        while (TenantModel::where('mysql_database' , $name)->exists()) {
            $name = 'eshoppica_'.str_random('16');
        }
        return $name;
    }
}
