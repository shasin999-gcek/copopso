<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table = 'results';
    public $timestamps = true;

    public function scopeIsExists($query, $academic_year, $semester)
    {
    	return $query->where([
          ["academic_year", $academic_year],
          ["semester", $semester]
        ]);
    }
}
