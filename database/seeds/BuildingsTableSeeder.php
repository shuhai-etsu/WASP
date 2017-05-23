<?php

use Illuminate\Database\Seeder;

use App\Building;

/**
 * Class: BuildingsTableSeeder
 *
 * Purpose: Seeds the buildings table with default data.
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
class BuildingsTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the age_group_types table with default data supplied in a pipe (|) delimited text file.
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
            $file = fopen((getcwd() . "/database/seeds/default/buildings.txt"), "r")
            or die("Unable to open file buildings.txt");

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
                        $obj = new Building;

                        $obj->abbreviation = trim($data[0]);
                        $obj->description = trim($data[1]);
                        $obj->address1 = trim($data[2]);
                        $obj->address2 = trim($data[3]);
                        $obj->city = trim($data[4]);
                        $obj->state_id = trim($data[5]);
                        $obj->zipcode = trim($data[6]);
                        $obj->default_selection = (intval(trim($data[7])) > 0);

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
