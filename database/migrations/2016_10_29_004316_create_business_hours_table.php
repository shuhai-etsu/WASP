<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateBusinessHoursTable
 *
 * Purpose:
 *
 * Notes:
 *
 * @todo - complete class header comment
 *
 * Requirement(s):
 *
 *      Document                        Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * Modification History:
 *
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateBusinessHoursTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the weekdays table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hours', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('weekday_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the weekdays table.';

            $table->foreign('weekday_id')
                  ->references('id')
                  ->on('weekdays')
                  ->comment = 'Foreign key constraint linking back to the weekdays table.';

            $table->string('start_time', 5)
                  ->comment = 'Time when an employee can begin work, such as 08:00 or 8 am.';

            $table->string('end_time', 5)
                  ->comment = 'Time when an employee ends work, such as 17:00 or 5 pm.';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the entry.';

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
        Schema::drop('business_hours');
    }
}
