<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateSchedulesTable
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
class CreateSchedulesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the semesters table must be created before running this routine
     * -.  the classrooms table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->string('abbreviation', 25)
                  ->unique()
                  ->comment = 'Abbreviation of a given schedule entry.';

            $table->string('description', 100)
                  ->unique()
                  ->comment = 'Description of a given schedule entry.';

            $table->unsignedInteger('semester_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the semesters table.';

            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters')
                  ->comment = 'Foreign key constraint linking back to the semesters table.';

            $table->unsignedInteger('classroom_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the classrooms table.';

            $table->foreign('classroom_id')
                  ->references('id')
                  ->on('classrooms')
                  ->comment = 'Foreign key constraint linking back to the classrooms table.';

            $table->boolean('enabled')
                  ->default(true)
                  ->comment = 'Determines if the schedule is enabled/disabled. 0 = disabled, 1 = enabled.';


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
        Schema::drop('schedules');
    }
}
