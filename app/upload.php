<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    //
    protected $fillable=['rollno','name','t1','t2','a1','a2','i','u'];
    public $timestamps = false;
    public $incrementing = false;
}
