<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserAddressesTable
 *
 * Purpose: Class is used create and drop the user_addresses table, which stores address information for a given user.
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
class CreateUserAddressesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the states table must be created before running this routine
     *
     * @return void
     *
     * @todo Consider using a prefix and postfix for zip codes instead of making it one field
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) 
        {
            $table->increments('id')
                  ->comment = 'Primary key.';
            
            $table->integer('user_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to a given user in the Users table.';

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->comment = 'Foreign key constraint linking back to the users table.';
            
            $table->string('address1',100)
                  ->comment = 'Users address.';
            
            $table->string('address2',100)
                  ->comment = 'Continuation of users address (if needed).';
            
            $table->string('city',25)
                  ->index()
                  ->comment = 'City where the residence is located.';
            
            $table->integer('state_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the states table.';
            
            $table->foreign('state_id')
                  ->references('id')
                  ->on('states')
                  ->comment = 'Foreign key constraint linking back to the states table.';

            $table->integer('country_id')
                ->unsigned()
                ->index()
                ->comment = 'Foreign key linking back to the countries table.';

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->comment = 'Foreign key constraint linking back to the countries table.';

            $table->string('zipcode',10)
                ->comment = 'Zip code where the residence is located.';

            $table->string('comment',255)
                  ->nullable()
                  ->comment = 'Brief comment about the given user address entry.';

            $table->boolean('is_primary')
                  ->default(false)
                  ->comment = 'Determines if the entry is the primary address for a given user.';

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
        Schema::drop('user_addresses');
    }
}
