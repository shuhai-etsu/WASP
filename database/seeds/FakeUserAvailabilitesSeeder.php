<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

use App\User;
use App\Weekday;
use App\Semester;
use App\UserAvailability;

/**
 * Class FakeUserAvailabilitesSeeder
 *
 * Preconditions:
 * -.  assumes Users table has been populated before execution
 * -.  assumes initial line in users table can be ignored
 *
 * @todo - add class header comment
 */

class FakeUserAvailabilitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Preconditions:
     * -.  assumes Semester table was initialized
     * -.  assumes initial entry in Semesters can be ignored
     * -.  assumes Weekday table was initialized
     * -.  assumes initial entry in Weekday can be ignored
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $semesters = Semester::where('id', '>', 1)->get();
        $weekdays = Weekday::where('id', '>', 1)
                           ->where('id', '<', 7)->get();

        $availabilities = array
        (
          array('07:30:00', '09:30:00'),
          array('08:00:00', '10:00:00'),
          array('08:30:00', '10:30:00'),
          array('09:00:00', '11:00:00'),
          array('09:30:00', '11:30:00'),
          array('10:00:00', '12:00:00'),
          array('10:30:00', '12:30:00'),
          array('11:00:00', '13:00:00'),
          array('11:30:00', '13:30:00'),
          array('12:00:00', '14:00:00'),
          array('12:30:00', '14:30:00'),
          array('13:00:00', '15:00:00'),
          array('13:30:00', '15:30:00'),
          array('14:00:00', '16:00:00'),
          array('14:30:00', '16:30:00'),
          array('15:00:00', '17:00:00'),
          array('16:00:00', '17:00:00')
        );

        foreach ($users as $user)
        {
            foreach ($semesters AS $semester) 
            {
                foreach ($weekdays as $day) 
                {
                    $index = rand(1, (count($availabilities) - 1));
                    $tmp = $availabilities[$index];

                    $start = $tmp[0];
                    $end = $tmp[1];

                    $start = explode(':', $start);
                    $end =  explode(':', $end);

                    $obj = new UserAvailability;

                    $obj->user_id = $user->id;
                    $obj->weekday_id = $day->id;
                    $obj->start_time = Carbon::createFromTime(intval($start[0]), intval($start[1]), intval($start[2]));
                    $obj->end_time = Carbon::createFromTime(intval($end[0]), intval($end[1]), intval($end[2]));
                    $obj->semester_id = $semester->id;

                    $obj->save();
                }
            }
        }
    }
}