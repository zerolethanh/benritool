<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $hidden = ['user_id'];
    protected $guarded = ['id'];
}
