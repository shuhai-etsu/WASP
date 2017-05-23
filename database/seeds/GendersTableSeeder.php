<?php

use Illuminate\Database\Seeder;

/**
 * Class: GendersTableSeeder
 *
 * Purpose: Seeds the genders table with default data.
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
class GendersTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the genders table with default data supplied in a pipe (|) delimited text file.
     *
     * @return void
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/genders.txt", "genders");
    }       
            
}
