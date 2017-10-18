<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('courses')->insert([
				array(
					'id' => 1,
					'course_code' => "MA102",
					'course_name' => "DIFFERENTIAL EQUATIONS"
				),
				array(
					'id' => 2,
					'course_code' => "CY100",
					'course_name' => "ENGINEERING CHEMISTRY"
				),
				array(
					'id' => 3,
					'course_code' => "BE110",
					'course_name' => "ENGINEERING GRAPHICS"
				),
				array(
					'id' => 4,
					'course_code' => "BE102",
					'course_name' => "DESIGN&ENGINEERING"
				),
				array(
					'id' => 5,
					'course_code' => "CS100",
					'course_name' => "BASICS OF COMPUTER PROGRAMMING"
				),
				array(
					'id' => 6,
					'course_code' => "EE100",
					'course_name' => "BASICS OF ELECTRICAL ENGINEERING"
				),

	    ]);
    }
}
