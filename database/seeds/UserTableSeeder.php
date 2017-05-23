<?php

use Illuminate\Database\Seeder;

use App\User;   //For storing user information in the database
use App\Gender; //For accessing gender types stored in the database.

/**
 * Class: UserTableSeeder
 *
 * Purpose: Seeds the users table with default data.
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * Modification History:
 *
 *      Developer           Date            Description
 *      ----------------------------------------------------------------------------------------------------------------
 *      Dave Bishop         05/15/2016      Initial design
 */
class UserTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the users table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/users.txt - initial values for users table, formatted as a combined list of
     *       -.  comment lines - begin with '#'; ignored
     *       -.  data lines - vertical-bar-separated ordered data to place into table records, one record per line
     *
     * @todo - remove code for populating gender and alternate_email fields from this table when that content
     * is stripped from the database.
     *
     * @return void
     */
    public function run()
    {
        try
        {
            //==========================================================================================================
            //Attempt to open and process the text file that contains default user data
            //==========================================================================================================
            $file = fopen((getcwd() . "/database/seeds/default/users.txt"), "r")
                    or die("Unable to open file users.txt");

            while (!feof($file))
            {
                $data = trim(fgets($file));

                //======================================================================================================
                //Ignore comments (#) and process the file.
                //======================================================================================================
                if (strlen($data) > 0 && strpos($data, "#") === false)
                {
                    $data = explode("|", $data);

                    if (count($data) > 0)
                    {
                        $obj = new User;
                        $obj->enumber = trim($data[0]);
                        $obj->first_name = trim($data[1]);
                        $obj->middle_name = trim($data[2]);
                        $obj->last_name = trim($data[3]);
                        $obj->suffix_id = trim($data[5]);
                        $obj->role_id = trim($data[6]);
                        $obj->email = trim($data[7]);
                        $obj->password = bcrypt(trim($data[8]));
                        $obj->user_status_id = trim($data[9]);

                        $obj->save();
                    }
                }
            }
        }
        //==============================================================================================================
        //Free up memory allocated to the function.
        //==============================================================================================================
        finally
        {
            fclose($file);

            $obj = null;
            $data = null;
            $file = null;
        }
    }
}
