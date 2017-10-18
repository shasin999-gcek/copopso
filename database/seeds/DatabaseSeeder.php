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
        	    
        $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(UserCourseTableSeeder::class);
        $this->call(POTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
    }

}
