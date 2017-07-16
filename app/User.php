<?php
namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements Authenticatable, CanResetPasswordContract
{
    use Notifiable;
    use AuthenticableTrait;
    use CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'department', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses()
    {
        return $this -> belongsToMany(Course::class, 'user_course')->withPivot('id','semester','academic_year','branch','co_count', 'status');
    }

    // public function usercourse()
    // {
    //     return $this -> belongsToMany(UserCourse::class, 'user_course');
    // }
  }
