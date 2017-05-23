<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateSemestersTable
 *
 * Purpose: Class is used create and drop the semesters table, which stores information about a given work semester.
 *
 * Considerations: Table uses timestamps() to denote creation and modification dates/times. Table also uses
 *                 softDeletes() to mark the item as deleted rather then removing it from the database since the
 *                 item may be associated with historical data.
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
class CreateSemestersTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @todo Consider adding an ordering column. See ordering notes listed below.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->string('abbreviation')
                  ->index()
                  ->comment = 'Abbreviation of the semester.';

            $table->string('description')
                  ->index()
                  ->comment = 'Name/description of the semester.';

            $table->date('start_date')
                  ->index()
                  ->comment = 'Date the semester starts.';

            $table->date('end_date')
                  ->index()
                  ->comment = 'Date the semester ends.';

            $table->float('time_increment')
                  ->default(1.0)
                  ->comment = 'Time increment that is used to divide a work day into allowed time increments, such as
                               8:00 am - 9:00 am (1 hour increment).';

            $table->boolean('enabled')
                  ->default(true)
                  ->comment = 'Determines whether the semester is enabled and can accept scheduling entries';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the entry';

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
        Schema::drop('semesters');
    }
}
