<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Semester;
use App\Classroom;
use App\ClassroomAssignment;

/**
 * Class FakeUserClassroomAssignmentsSeeder
 *
 * @todo - add class header comment
 */

class FakeUserClassroomAssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * External Dependencies:
     * -.  assumes Semester table was initialized
     * -.  assumes initial entry in Semesters can be ignored
     * -.  assumes Classroom table was initialized
     * -.  assumes initial entry in Classroom can be ignored
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $semesters = Semester::where('id', '>', 1)->get();
        $count = (Classroom::where('id', '>', 1)->count()) - 1;

        foreach ($users as $user)
        {
            foreach ($semesters AS $semester)
            {
                $classroom_id = rand(2,$count);

                $obj = new ClassroomAssignment;

                $obj->user_id = $user->id;
                $obj->semester_id = $semester->id;
                $obj->classroom_id = $classroom_id;

                $obj->save();
            }
        }
    }
}
