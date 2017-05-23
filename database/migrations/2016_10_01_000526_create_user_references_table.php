<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserReferencesTable
 *
 * Purpose:
 *
 * Notes:
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
class CreateUserReferencesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  users table must be created before running this routine
     * -.  telephone_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_references', function (Blueprint $table)
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

            $table->string('first_name', 25)
                  ->index()
                  ->comment = 'First name of reference.';

            $table->string('middle_name', 25)
                  ->nullable()
                  ->index()
                  ->comment = 'Middle name of reference.';

            $table->string('last_name', 25)
                  ->index()
                  ->comment = 'Last name of reference.';

            $table->string('telephone_number', 25)
                  ->index()
                  ->comment = 'Reference telephone number.';

            $table->integer('type_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the telephone_types table.';

            $table->foreign('type_id')
                  ->references('id')
                  ->on('telephone_types')
                  ->comment = 'Foreign key constraint linking back to the telephone_types table.';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the entry.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
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
        Schema::drop('user_references');
    }
}
