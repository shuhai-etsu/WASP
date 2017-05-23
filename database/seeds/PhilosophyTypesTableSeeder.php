<?php

use Illuminate\Database\Seeder;

class PhilosophyTypesTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the genders table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/philosophy_types.txt - initial values for philosophy_types table,
     *       formatted as
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * @todo why is Philosophy a picklist type???  Philosophies are crafted by users, not canned statements of intent.
     *
     * @return void
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/philosophy_types.txt", "philosophy_types");
    }
}
