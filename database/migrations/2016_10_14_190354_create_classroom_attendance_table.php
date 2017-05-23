<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateClassroomAttendanceTable
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
class CreateClassroomAttendanceTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the semester table must be created before running this routine
     * -.  the classroom table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_attendance', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('user_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->comment = 'Foreign key constraint linking back to the users table.';

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

            $table->date('day')
                  ->index()
                  ->comment = 'Attendance date.';

            $table->unsignedInteger('total_students')
                  ->comment = 'Total number of students that attended class.';

            $table->string('comment', 500)
                  ->comment = 'Brief comment about the entry.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->timestamps();
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
        Schema::drop('classroom_attendance');
    }
}
