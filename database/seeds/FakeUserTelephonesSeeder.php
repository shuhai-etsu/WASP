<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserTelephone;

/**
 * Class FakeUserTelephonesSeeder
 *
 * @todo - add class header comment
 */

class FakeUserTelephonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * External Dependencies:
     * -.  uses seeds/default/telephone_types.txt to determine number of phone types
     *
     * Preconditions:
     * -.  assumes Users table has been populated before execution
     * -.  assumes initial line in users table can be ignored
     * -.  assumes initial line in file can be ignored
     *
     * @todo - code for seeding areacode generates values in the 1xx range, along with reserved area codes
     *         like 800, 888, 877, and the x11s that are probably invalid - fix this
     *
     * @todo - process users.txt to determine the number of "real" user accounts in the initial database.
     * 11 just happens to be the number of non-comment lines in default\users.txt as of 02/25/2017
     *
     * @todo - improve on logic for randomizing telephone_types data
     * -.  add ordering dependency on preloading of telephone_types table;
     * -.  use count of record in talbe to drive randomization of telephone types
     *
     * @return void
     */
    public function run()
    {
        try
        {
            //Only add fake data to fake user accounts.
            $users = User::where('id', '>', 11)->get();
            $primary = true;
            $index = 0;
            $total = 0;
            
            foreach ($users as $user) 
            {
                while ($index < 2) 
                {
                    $obj = new UserTelephone;
                    $type = rand(1, countLines(database_path('seeds/default/telephone_types.txt'))-1);
            
                    $areacode = rand(100,999);
                    $prefix = rand(100,999);
                    $postfix = rand(1000,9999);
                    
                    $obj->user_id = $user->id;
                    $obj->type_id = $type;
                    $obj->telephone_number = "(" . $areacode . ")" . " " . $prefix . "-" . $postfix;
                    $obj->is_primary = $primary;

                    $obj->save();
                    
                    $primary = false;
                    $index = $index + 1;
                    $total = $total + 1;
                }
                
                $primary = true;
                $index = 0;
            }
        }
        finally
        {
            $obj = null;
            $min = null;
            $max = null;
            $exMin = null;
            $exMax = null;
            $val = null;
            $exVal = null;
            $certID = null;
        }
    }
}
