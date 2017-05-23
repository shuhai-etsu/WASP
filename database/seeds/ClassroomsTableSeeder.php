<?php

use Illuminate\Database\Seeder;

use App\Classroom;

/**
 * Class: ClassroomsTableSeeder
 *
 * Purpose: Seeds the classrooms table with default data.
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
class ClassroomsTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the classrooms table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/classrooms.txt - initial values for classrooms table,
     *       formatted as a combined list of
     *       -.  comment lines - begin with '#'; ignored
     *       -.  data lines - vertical-bar-separated ordered data to place into table records, one record per line
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
            $file = fopen((getcwd() . "/database/seeds/default/classrooms.txt"), "r")
            or die("Unable to open file classrooms.txt");

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
                        $obj = new Classroom;

                        $obj->abbreviation = trim($data[0]);
                        $obj->description = trim($data[1]);
                        $obj->minimum_students = trim($data[2]);
                        $obj->maximum_students = trim($data[3]);

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
