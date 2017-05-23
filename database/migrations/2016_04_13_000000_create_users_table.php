<?php

use Illuminate\Database\Schema\Blueprint;       //Used for creating the schema's blueprint or table structure
use Illuminate\Database\Migrations\Migration;   //Used for creating and droping the table

/**
 * Class: CreateUsersTable
 *
 * Purpose: The class is used create and drop the users table, which stores information on individuals who are granted
 *          access to user the application.
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
class CreateUsersTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     *
     * Preconditions:
     * -.  the titles table must be created before running this routine
     * -.  the suffixes table must be created before running this routine
     * -.  the roles table must be created before running this routine
     * -.  the user_status_types table must be created before running this routine
     *
     * @todo Consider adding a E-Number field and look at using bcrypt to hash passwords.
     * @todo Remove gender ID and alternate e-mail from this table, since both are being deprecated
     *
     * Modification History:
     *
     *      Developer           Date            Description
     *      ------------------------------------------------------------------------------------------------------------
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            /*$table->unsignedInteger('title_id')
                  ->default(1)
                  ->index()
                  ->comment = 'Foreign key to a titles table entry that identifies the title of the given user.';

            $table->foreign('title_id')
                  ->references('id')
                  ->on('titles')
                  ->comment = 'Foreign key constraint linking back to the titles table.';*/
            $table->string('enumber', 15)
                ->index()
                ->comment = 'Users Enumber.';

            $table->string('first_name', 25)
                  ->index()
                  ->comment = 'Users first name.';

            $table->string('middle_name', 25)
                  ->comment = 'Users middle name.';

            $table->string('last_name', 25)
                  ->index()
                  ->comment = 'Users last name.';

            $table->unsignedInteger('suffix_id')
                  ->default(1)
                  ->index()
                  ->comment = 'Foreign key to a suffixes table entry that identifies a suffix (e.g. Jr., etc.) assigned 
                               to the given user.';

            $table->foreign('suffix_id')
                  ->references('id')
                  ->on('suffixes')
                  ->default(1)
                  ->comment = 'Foreign key constraint linking back to the suffixes table.';

            /*$table->unsignedInteger('gender_id')
                  ->default(1)
                  ->index()
                  ->comment = 'Foreign key to a genders table entry that identifies the gender of the given user.';

            $table->foreign('gender_id')
                  ->references('id')
                  ->on('genders')
                  ->comment = 'Foreign key constraint linking back to the genders table.';*/

            $table->unsignedInteger('over_18')
                  ->default(0)
                  ->comment = 'Flag used to determine if the user is over 18 years old';

            $table->unsignedInteger('role_id')
                  ->default(1)
                  ->index()
                  ->comment = 'Foreign key to a roles table entry that identifies the role (e.g. Teacher, etc.) of the 
                               given user.';

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->comment = 'Foreign key constraint linking back to the roles table.';

            $table->string('email', 50)
                  ->unique()
                  ->comment = 'Users primary email address.';

            $table->string('alternate_email', 50)
                  ->nullable()
                  ->comment = 'Users alternate email address.';

            $table->string('password', 255)
                  ->comment = 'Users password';

            $table->unsignedInteger('user_status_id')
                  ->default(1)
                  ->index()
                  ->comment = 'Foreign key to a user_status_types table entry that is used to determine the users 
                              status';

            $table->foreign('user_status_id')
                  ->references('id')
                  ->on('user_status_types')
                  ->comment = 'Foreign key constraint linking back to the roles table';

            $table->boolean('enabled')
                  ->default(true)
                  ->comment = 'Determines if the entry enabled or disabled.';

            $table->rememberToken();

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->softDeletes();
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
        Schema::drop('users');
    }
}
