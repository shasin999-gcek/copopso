<?php

use Illuminate\Database\Seeder;

class UserCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('user_course')->insert([
				array(
					'id' => 1,
					'user_id' => 100,
					'course_id' => 1,
					'semester' => 2,
					'academic_year' => "2016-2017",
					'branch' => "CSE",
					'co_count' => 0,
					'status' => 0
				),
				array(
					'id' => 2,
					'user_id' => 100,
					'course_id' => 2,
					'semester' => 2,
					'academic_year' => "2016-2017",
					'branch' => "CSE",
					'co_count' => 0,
					'status' => 0
				),
	      array(
					'id' => 3,
					'user_id' => 100,
					'course_id' => 3,
					'semester' => 2,
					'academic_year' => "2016-2017",
					'branch' => "CSE",
					'co_count' => 0,
					'status' => 0
				),
				array(
					'id' => 4,
					'user_id' => 100,
					'course_id' => 4,
					'semester' => 2,
					'academic_year' => "2016-2017",
					'branch' => "CSE",
					'co_count' => 0,
					'status' => 0
				),
				array(
					'id' => 5,
					'user_id' => 100,
					'course_id' => 5,
					'semester' => 2,
					'academic_year' => "2016-2017",
					'branch' => "CSE",
					'co_count' => 0,
					'status' => 0
				),
	      array(
					'id' => 6,
					'user_id' => 100,
					'course_id' => 6,
					'semester' => 2,
					'academic_year' => "2016-2017",
					'branch' => "CSE",
					'co_count' => 0,
					'status' => 0
				)

    	]);
    }
}
