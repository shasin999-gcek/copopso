<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    public $timestamps = false;

    protected $guarded = [];

    public function usercourse()
    {
        return $this ->belongsTo(UserCourse::class);
    }
}
