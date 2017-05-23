<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserDocumentsTable
 *
 * Purpose: Class is used to create and drop the user_documents table, which stores required documents information for a given
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

class CreateUserDocumentsTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the document_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
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

            $table->string('name', 50)
                ->index()
                ->comment = 'Name of the document';

            $table->integer('type_id')
                ->unsigned()
                ->index()
                ->comment = 'Foreign key linking back to the telephone_types table.';

            $table->foreign('type_id')
                ->references('id')
                ->on('document_types')
                ->comment = 'Foreign key constraint linking back to the document_types table.';

            $table->string('filename', 255)
                ->comment = 'Name of the scanned image file of the document';

            $table->string('comment',255)
                ->nullable()
                ->comment = 'Brief comment about the given building entry.';

            $table->date('expiration_date')
                ->nullable() //default('1900-01-01')
                ->index()
                ->comment = 'Date the certification expires (if applicable).';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
}
