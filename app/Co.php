<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserCourse;
use App\CoPo;

class Co extends Model
{
    //
 
    protected $table = 'cos';
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'description', 'user_course_id'
    ];

    public $timestamps = false;

    public function usercourse()
    {
         return $this->belongsTo(UserCourse::class);
    }

    public function copo()
    {
         return $this->hasOne(CoPo::class);
    }

}
