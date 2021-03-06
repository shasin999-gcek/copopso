<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserCourse;
use App\Po;
use App\Co;
use App\CoPo;

class UserApiController extends Controller
{
  /**
   * get registered courses of Auth user
   * @param  void
   * @return courses
   */

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

  // fetch all program outcomes
  // @return App\Po
  public function get_program_outcomes() {
    return Po::all();
  }

  /**
  * grab all copopso map
  * @param user_course_id
  * @return assossiative array contains mapping, status and co count
  */
  public function get_copopso_map($user_course_id) {
    // grab all cos
    $cos = Co::where('user_course_id', $user_course_id)->orderBy('name')->get();

    // combine po-pos map of each cos
    foreach ($cos as $co) {
        $copopso= CoPo::where('co_id', $co->id)->first();

        if($copopso == null)
          break;

        //to convert 0 to -
        $copopso=$copopso->getAttributes();
        foreach ($copopso as $key => $value) {

            if ($key !== "co_id")
            {
                if ($value === 0)
                {
                    $copopso[$key] = "-";
                }
            }
        }

        $co["popso"] = array_except($copopso,['co_id']);

    }

    $usercourse = UserCourse::find($user_course_id);

    // return copopso map, status and co_count
    return ['copopso_map' => $cos, 'status' => $usercourse->status, 'co_count' => $usercourse->co_count];
  }

  /**
  * grab all copo map
  * @param user_course_id. po_id
  * @return assossiative array contains po mapping
  */

  public function get_copo_map($user_course_id, $po_id) {

    $coursedata = UserCourse::find($user_course_id);
    $cos = Co::where('user_course_id', $user_course_id)->get();


    $copo=array();
    foreach ($cos as $co) {
      //If the value is non-zero, store co_name, co_id and po_value in $codata
      $codata=array();
      $codata["name"]=$co->name;
      $codata["description"]=$co->description;
      $codata["id"]=$co->id;
      $codata["po_value"]=$co->copo["po".$po_id];
      $copo[] = $codata;

    };

    return $copo;
  }

}
