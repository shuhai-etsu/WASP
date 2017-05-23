<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserEmailAddress;

/**
 * Class UserEmailAddressSeeder
 *
 * @todo complete class header comments
 */

class UserEmailAddressSeeder extends Seeder
{
    /**
     * External Dependencies:
     *
     *   -.  /database/seeds/default/user_email_addresses.txt - initial values for user_email_addresses table,
     *       formatted as a combined list of
     *       -.  comment lines - begin with '#'; ignored
     *       -.  data lines - vertical-bar-separated ordered data to place into table records, one record per line
     *
     * @todo complete header comments
     *
     * @throws Exception
     */
    public function run()
    {
        try
        {
            //==========================================================================================================
            //Attempt to open and process the text file that contains default user data
            //==========================================================================================================
            $file = fopen((getcwd() . "/database/seeds/default/user_email_addresses.txt"), "r")
            or die("Unable to open file user_email_addresses.txt");

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
                        $firstName = trim($data[0]);
                        $lastName =  trim($data[1]);
                        $email = trim($data[2]);
                        $is_primary = intval(trim($data[3]));

                        $user = User::where('first_name','=', $firstName)
                                    ->where('last_name','=', $lastName)->first();

                        if($user)
                        {
                            $obj = new UserEmailAddress;

                            $obj->user_id = $user->id;
                            $obj->email = $email;
                            $obj->is_primary = ($is_primary == 1) ? true : false;

                            $obj->save();
                        }
                        else
                        {
                            throw new Exception('UserEmailAddressSeeder: User ' . $firstName . ' ' .
                                                $lastName . ' not found in the database.');
                        }
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
            $firstName = null;
            $lastName = null;
            $email = null;
            $is_primary = null;
        }
    }
}
