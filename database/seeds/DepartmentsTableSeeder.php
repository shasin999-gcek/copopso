<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('departments')->insert([
       	[
       		"name" => "Computer Science",
       		"is_accredited" => 0
       	],
       	[
       		"name" => "Electrical And Electronics Engineering",
       		"is_accredited" => 1
       	],
       	[
       		"name" => "Electronics And Communications Engineering",
       		"is_accredited" => 1
       	],
       	[
       		"name" => "Mechanical Engineering",
       		"is_accredited" => 1
       	],
       	[
       		"name" => "Civil Engineering",
       		"is_accredited" => 1
       	],
       ]);
    }
}
