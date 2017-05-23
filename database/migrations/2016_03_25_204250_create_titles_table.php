<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Class: CreateTitlesTable
 *
 * Purpose:
 *
 * Notes:
 *
 * @todo complete class header comments
 *
 * Requirement(s):
 *
 *      Document                        Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 * Modification History:
 *
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateTitlesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     *
     * @todo Consider how to adjust the table structure, if necessary, to support nested entries. See ordering notes
     * below.
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table)
        {
            $table->increments('id')
                ->comment = 'Primary key.';

            $table->string('abbreviation', 10)
                ->unique()
                ->comment = 'Abbreviation of a given title, such as Mr. for Mister.';

            $table->string('description', 25)
                ->unique()
                ->comment = 'Description of a given title, such as Mister.';

            $table->string('comment', 255)
                ->nullable()
                ->comment = 'Brief comment about the title entry.';

            $table->boolean('enabled')
                  ->default(true)
                  ->comment = 'Determines if the entry enabled or disabled.';

            $table->boolean('default_selection')
                  ->default(false)
                  ->comment = 'Determines if the entry should be shown as the default selection in UI controls.';

            //==========================================================================================================
            //Need to consider adding an order field for display purposes. Furthermore, determine whether the field
            //should auto-increment or be manually incremented using DB::table(TABLE_NAME)->increment('ordering', VALUE)
            //call.
            //==========================================================================================================
            //$table->integer('ordering')
            //      ->default(0)
            //      ->comment = 'Used to determine the ordering shown in drop down boxes, lists, etc.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Function: down()
     *
     * Purpose: Reverses the migration (e.g. drop the table).
     *
     * @todo should this routine call dropIfExists() instead of drop()?
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('titles');
    }
}
