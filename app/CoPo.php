<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoPo extends Model
{
    //
    protected $table = 'co_po';

    public function co()
    {
         return $this->hasOne(Co::class);
    }

}
