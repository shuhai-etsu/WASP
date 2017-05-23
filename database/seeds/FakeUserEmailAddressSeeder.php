<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserEmailAddress;

/**
 * Class FakeUserEmailAddressSeeder
 *
 * @todo - add class header comment
 */

class FakeUserEmailAddressSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the users table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     * -.  assumes Users table has been populated before execution
     * -.  assumes UserEmailAddress table has been populated before execution
     *
     * @todo - process users.txt to determine the number of "real" user accounts in the initial database.
     * 11 just happens to be the number of non-comment lines in default\users.txt as of 02/25/2017
     *
     * @return void
     */
    public function run()
    {
        try
        {
            $users = User::where('id','>',11)->get();

            foreach($users as $user)
            {
                $email = $user->first_name . "." . $user->last_name . "@etsu.edu";

                $result = UserEmailAddress::where('email_address', '=', $email)->get();

                //======================================================================================================
                //Check for duplicate entries and disregard if a duplicate is found
                //======================================================================================================
                if($result->count() > 0)
                {
                    $email = $user->first_name . "." . $user->last_name . rand(1,100) . "@etsu.edu";
                }

                $obj = new UserEmailAddress;

                $obj->user_id = $user->id;
                $obj->email = $email;
                $obj->is_primary = true;
                $obj->save();
            }
        }
        //==============================================================================================================
        //Clean up allocated memory.
        //==============================================================================================================
        finally
        {
            $obj = null;
            $users = null;
        }
    }
}
