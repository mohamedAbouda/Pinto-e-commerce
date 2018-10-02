<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileCSV extends Model
{
    protected $connection = 'mysql';
    protected $table='file_csv';
    protected $fillable=[
        'path',
    ];
}
