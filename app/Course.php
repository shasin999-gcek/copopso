<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //Since table is named course right now:
    protected $table = 'course';

    protected $fillable = [
        'id', 'course_code', 'course_name'
    ];
	
	public function users()
    {
        return $this -> belongsToMany(User::class, 'user_course')->withPivot('id','semester','academic_year','branch','co_count');
    }
    // public function usercourse()
    // {
    //     return $this ->belongsToMany(UserCourse::class);
    // }
    public function usercourse()
    {
        return $this ->hasMany(UserCourse::class);
    }

}
