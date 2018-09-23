<?php

namespace App\Support;

trait BaseModelTrait
{
    use TenantConnector;
    protected $connection = 'tenant';

    /**
    * @return $this
    */
    public function connect() {
        $this->reconnect($this);
        return $this;
    }
}
