<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolicyFAQ extends Model
{
    protected $table = 'policy_faqs';
    protected $fillable = [
        'question' ,'answer'
    ];
}
