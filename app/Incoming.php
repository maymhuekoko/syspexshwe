<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    //
    protected $fillable = [

        'type','date','remark','amount'
    ];
}
