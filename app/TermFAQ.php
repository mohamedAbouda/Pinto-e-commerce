<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermFAQ extends Model
{
    protected $table = 'term_faqs';
    protected $fillable = [
        'question' ,'answer'
    ];
}
