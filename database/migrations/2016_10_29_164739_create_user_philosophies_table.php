<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserPhilosophiesTable
 *
 * Purpose: Class is used to create the user_philosophies table that stores philosophies entered by prospective
 * employees during their application process.
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
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateUserPhilosophiesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the philosophy_types table must be created before running this routine
     *
     * @todo remove foreign key on philosophy_types, type_id from logic?
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_philosophies', function (Blueprint $table)
        {
            $table->increments('id')
                ->comment = 'Primary key.';

            $table->unsignedInteger('user_id')
                ->index()
                ->comment = 'Foreign key linking back to the users table.';

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->comment = 'Foreign key constraint linking back to the users table.';

            $table->unsignedInteger('type_id')
                ->index()
                ->comment = 'Foreign key linking back to the philosophy_types table.';

            $table->foreign('type_id')
                ->references('id')
                ->on('philosophy_types')
                ->comment = 'Foreign key constraint linking back to the philosophy_types table.';

            $table->text('philosophy')
                ->comment = 'Philosophy provided by the user.';

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
        Schema::drop('user_philosophies');
    }
}
