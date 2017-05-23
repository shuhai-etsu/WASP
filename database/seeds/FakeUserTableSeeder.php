<?php


use Illuminate\Database\Seeder;

use App\User;               //For accessing user types stored in the database.


/**
 * Class: UserTableFakeSeeder
 *
 * Purpose: Seeds the users table with FAKE data for testing purposes.
 *
 * Notes: None
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
 */
class FakeUserTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the users table with default data supplied in a pipe (|) delimited text file.
     *
     * @todo - drop gender from the seeding process.  this should simplify these codes a good bit
     * @todo - do something to eliminate the assumption that id 3 is the admin
     *
     * @return void
     */
    public function run()
    {
        try
        {
            //==========================================================================================================
            //Generate fake data using the Faker library and insert the fake data into the database for testing
            //purposes.
            //==========================================================================================================

            $faker = Faker\Factory::create();
            $i = 12;

            //==========================================================================================================
            //Create [n] number of fake user records and store them in the database.
            //==========================================================================================================
            foreach (range(1,200) as $index)
            {
                //======================================================================================================
                //Be sure to handle certain information for male and female entries differently.
                //======================================================================================================
                if ($index % 2 <= 0)
                {
                    $firstName = $faker->firstNameMale;
                    $middleName = $faker->firstNameMale;
                    $suffix = rand(1, countLines(database_path('seeds/default/suffixes.txt'))-1);
                }
                else
                {
                    $firstName = $faker->firstNameFemale;
                    $middleName = $faker->firstNameFemale;
                    $suffix = 1;
                }

                $lastName = $faker->lastName;
                $role = rand(1,countLines(database_path('seeds/default/roles.txt'))-1);

                //Prevent admin roles to be assigned by faker library
                if($role == 3)
                {
                    $role = $role + 1;
                }

                $email = $firstName . "." . $lastName . "@mail.etsu.edu";

                //Check for duplicate entries and disregard if a duplicate is found
                $tmp = User::where('email', '=', $email)->get();

                if(!$tmp->isEmpty())
                {
                    $email = $firstName . "." . $lastName . rand(1,100) . "@etsu.edu";
                }

                $obj = new User;
                $obj->enumber = 'E000000'.$i;
                $obj->first_name = $firstName;
                $obj->middle_name = $middleName;
                $obj->last_name = $lastName;
                $obj->suffix_id = $suffix;
                
                //An application can only have roles PENDING, NEW, SHELVED, INTERVIEW, REJECTED
                if($role==config('constants.role.APPLICATION')) {
                    $obj->user_status_id = rand(config('constants.user_status.PENDING'), countLines(database_path('seeds/default/user_status_types.txt')) - 1);
                }
                else{
                    $obj->user_status_id = rand(config('constants.user_status.ACTIVE'), config('constants.user_status.DORMANT'));
                }
                $obj->role_id = $role;
                $obj->email = $email;
                $obj->password =  bcrypt(trim('test'));
                $i++;
                $obj->save();
            }
        }
            //==============================================================================================================
            //Clean up allocated memory.
            //==============================================================================================================
        finally
        {
            $obj = null;
            $male = null;
            $faker = null;
            $female = null;
        }
    }
}