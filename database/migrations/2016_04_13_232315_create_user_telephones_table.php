<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserTelephonesTable
 *
 * Purpose: Class is used create and drop the user_telephones table, which stores telephone information for a given
 *          user.
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
 *
 *
 */
class CreateUserTelephonesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the telephone_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_telephones', function (Blueprint $table)
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

            $table->string('telephone_number', 25)
                  ->index()
                  ->comment = 'Users telephone number.';

            $table->integer('type_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the telephone_types table.';

            $table->foreign('type_id')
                  ->references('id')
                  ->on('telephone_types')
                  ->comment = 'Foreign key constraint linking back to the telephone_types table.';

            $table->string('comment',255)
                  ->nullable()
                  ->comment = 'Brief comment about the given building entry.';
            
            $table->boolean('is_primary')
                  ->default(false)
                  ->comment = 'Determines if the entry is the primary telephone number for a given user.';
            
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
        Schema::drop('user_telephones');
    }
}
