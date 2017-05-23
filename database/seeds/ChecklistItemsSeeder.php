<?php

use Illuminate\Database\Seeder;
/**
 * Class: ChecklistItemsSeeder
 *
 * Purpose: Seeds the Checklist_document_types table with default data.
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

class ChecklistItemsSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the Checklist_items table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/checklist_items.txt - initial values for, checklist_items table,
     *       formatted as
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * @return void
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/checklist_items.txt","checklist_items");
    }
}