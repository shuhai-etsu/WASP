<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateScheduleEntriesTable
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
 *
 * Modification History:
 *
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateScheduleEntriesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  users must be populated before running this routine
     * -.  schedules must be populated before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_entries', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('schedule_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the schedules table.';

            $table->foreign('schedule_id')
                  ->references('id')
                  ->on('schedules')
                  ->onDelete('cascade')
                  ->comment = 'Foreign key constraint linking back to the schedules table.';

            $table->unsignedInteger('user_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->comment = 'Foreign key constraint linking back to the users table.';

            $table->date('day')
                  ->index()
                  ->comment = 'Day the user is scheduled to work.';

/*            $table->integer('weekday_id')
                ->unsigned()
                ->index()
                ->comment = 'Foreign key linking back to the weekdays table.';

            $table->foreign('weekday_id')
                ->references('id')
                ->on('weekdays')
                ->comment = 'Foreign key constraint linking back to the weekdays table.';*/

            $table->time('start_time')
                  ->index()
                  ->comment = 'Time user starts work.';

            $table->time('end_time')
                  ->index()
                  ->comment = 'Time user ends work.';

            $table->string('background_color', 10)
                  ->nullable()
                  ->comment = 'Background color used by the scheduler to display the entry.';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the entry.';

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @todo should this routine call dropIfExists() instead of drop()?
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedule_entries');
    }
}
