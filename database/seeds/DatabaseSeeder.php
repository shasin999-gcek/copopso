<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pos')->insert([
        	array(
                'id'   => '1',
                'name' => 'Engineering Knowledge',
                'body' => 'Apply the knowledge of mathematics, science, engineering fundamentals, and an engineering specialisation to the solution of complex engineering problems.'
	        ),

	        array(
	                'id'   => '2',
	                'name' => 'Problem analysis',
	                'body' => 'Identify, formulate, research literature, and analyse complex engineering problems reaching substantiated conclusions using first principles of mathematics, natural sciences, and engineering sciences.'
	        ),
	        array(
	                'id'   => '3',
	                'name' => 'Design/ Development of Solutions',
	                'body' => 'Design solutions for complex engineering problems and design system components or processes that meet specified needs with appropriate consideration for public health and safety, cultural, societal and environmental considerations.'
	        ),
	        array(
	                'id'   => '4',
	                'name' => 'Conduct investigations of complex problems',
	                'body' => 'Use research-based knowledge and research methods including design of experiments, analysis and interpretation of data, and synthesis of the information to provide valid conclusions.'
	        ),
	        array(
	                'id'   => '5',
	                'name' => 'Modern Tool Usage',
	                'body' => 'Create, select, and apply appropriate techniques, resources, and modern engineering and IT tools including prediction and modelling to complex engineering activities with an understanding of the limitations.'
	        ),
	        array(
	                'id'   => '6',
	                'name' => 'The Engineer and Society',
	                'body' => 'Apply reasoning informed by the contextual knowledge to assess societal, health, safety, legal, and cultural issues and the consequent responsibilities relevant to the professional engineering practice.'
	        ),
	        array(
	                'id'   => '7',
	                'name' => 'Environment and Sustainability',
	                'body' => 'Understand the impact of the professional engineering solutions in societal and environmental contexts, and demonstrate the knowledge of need for sustainable development.'
	        ),
	        array(
	                'id'   => '8',
	                'name' => 'Ethics',
	                'body' => 'Apply ethical principles and commit to professional ethics and responsibilities and norms of the engineering practice.'
	        ),
	        array(
	                'id'   => '9',
	                'name' => 'Individual and Team Work',
	                'body' => 'Function effectively as an individual, and as a member or leader in diverse teams, and in multidisciplinary settings.'
	        ),
	        array(
	                'id'   => '10',
	                'name' => 'Communication',
	                'body' => 'Communicate effectively on complex engineering activities with the engineering community and with society at large. Some of them are, being able to comprehend and write effective reports and design documentation, make effective presentations, and give and receive clear instructions.'
	        ),
	        array(
	                'id'   => '11',
	                'name' => 'Lifelong learning',
	                'body' => 'Recognise the need for, and have the preparation and ability to engage in independent and lifelong learning in the broadest context of technological change.'
	        ),
	        array(
	                'id'   => '12',
	                'name' => 'Project Management and Finance',
	                'body' => 'Demonstrate knowledge and understanding of the engineering and management principles and apply these to one’s own work, as a member and leader in a team, to manage projects and in multidisciplinary environments.'
	        ),
	 			]);

        /*User seeder*/
				DB::table('users')->insert([
		      [
					'id' => 100,
					'name' => "ABC",
					'email' => "abc@xyz.com",
					'password' => bcrypt("12345"),
					'department' => 'CSE'
		      ]
		    ]);

				/*Courses seeder*/
		    DB::table('course')->insert([
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

		  /*UserCourse seeder*/
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
