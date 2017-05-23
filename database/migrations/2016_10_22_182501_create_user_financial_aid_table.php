<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserFinancialAidTable
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
class CreateUserFinancialAidTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the financial_aid_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_financial_aid', function (Blueprint $table)
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
            
            $table->integer('type_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the financial_aid_types table.';

            $table->foreign('type_id')
                  ->references('id')
                  ->on('financial_aid_types')
                  ->comment = 'Foreign key constraint linking back to the financial_aid_types table.';

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
        Schema::drop('user_financial_aid');
    }
}
