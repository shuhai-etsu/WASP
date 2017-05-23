<?php

use Illuminate\Database\Seeder;

/**
 * Class TitleTableSeeder
 *
 * @todo add class header documentation
 */
class TitleTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the titles table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/titles.txt - initial values for titles table, formatted as
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * @return void
     *
     * Modification History:
     *
     *      Developer           Date            Description
     *      ------------------------------------------------------------------------------------------------------------
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/titles.txt","titles");
    }
}
