<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    //
    protected $table = 'user_course';
    public $timestamps = false;

    protected $fillable = [
        'id', 'user_id', 'course_id', 'semester', 'academic_year','branch','co_count', 'status'
    ];


    public function cos()
    {
         return $this ->hasMany(Co::class);
    }

    public function course()
    {
        return $this ->belongsTo(Course::class);
    }


}
