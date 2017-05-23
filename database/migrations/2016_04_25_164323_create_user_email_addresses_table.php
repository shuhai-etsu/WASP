<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserEmailAddressesTable
 *
 * Purpose: Class is used create and drop the user_email_addresses table, which stores email addresses for a given user.
 *
 * Notes: Table uses timestamps() to denote creation and modification dates/times. Table also uses softDeletes() to mark
 *        the item as deleted rather then removing it from the database since the item may be associated with historical
 *        data.
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
 *      Dave Bishop         11/22/16    Table was **** DEPRECATED **** based upon capstone and client comments. The
 *                                      application will now store a primary and alternate email addresses instead of
 *                                      allowing a user to enter multiple email addresses. The primary and alternate
 *                                      email addresses are now contained in the user's table (see users table for
 *                                      additional information). The user_email_addresses table was left in the
 *                                      application in case the requirement changed in the future.
 */
class CreateUserEmailAddressesTable extends Migration
{
    /**
     * Function: up()
     *
     * Preconditions:
     * -.  users table must be created before running this routine
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email_addresses', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->integer('user_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->comment = 'Foreign key constraint linking back to the users table.';

            $table->string('email', 50)
                  ->unique()
                  ->comment = 'Email address for a given user.';

            $table->boolean('is_primary')
                  ->default(false)
                  ->comment = 'Determines if the entry is the primary telephone number for a given user.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and soft deletes
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
        Schema::drop('user_email_addresses');
    }
}
