<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserCourse;

class UserApiController extends Controller
{
  //  get registered courses of Auth user
  public function get_courses() {
    return Auth::User() -> courses;
  }

  // current authenticated user data
  public function get_auth_user() {
    return Auth::User();
  }

  // get mapping of user to courses (ie.list of courses taken by current user)
  public function get_user_course_map($id) {
    $currUserId = Auth::id(); // current auth user id

    // grab all id of table user_course where user_id = current user id
    $userCourseIds = UserCourse::where('user_id', $currUserId)->pluck('id');

    foreach ($userCourseIds as $value) {
      if($id == $value) {
        $map = UserCourse::find($id);
        $map->course;
        $map->cos;

        return $map;
      }
    }

    return response("Forbidden",403)
            -> header('Content-Type', 'application/json');
  }

}
