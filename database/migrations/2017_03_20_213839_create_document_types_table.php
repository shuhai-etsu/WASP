<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateDocumentTypesTable
 *
 * Purpose: The class is used to create and drop the DocumentTypes table, which stores information on the types of documents
 *          (e.g. transcripts, degree, certificates, etc.) required by student to complete application
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


class CreateDocumentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->increments('id')
                ->comment = 'Primary key.';

            $table->string('abbreviation', 10)
                ->unique()
                ->comment = 'Abbreviation of a given gender entry, such as M for Male.';

            $table->string('description', 25)
                ->unique()
                ->comment = 'Description of a given gender entry, such as Male.';

            $table->string('comment', 255)
                ->nullable()
                ->comment = 'Brief comment about the given gender entry.';

            $table->boolean('enabled')
                ->default(true)
                ->comment = 'Determines if the entry enabled or disabled.';

            $table->boolean('default_selection')
                ->default(false)
                ->comment = 'Determines if the entry should be shown as the default selection in UI controls.';

            //==========================================================================================================
            //Need to consider adding an order field for display purposes. Furthermore, determine whether the field
            //should auto-increment or be manually incremented using DB::table(TABLE_NAME)->increment('ordering', VALUE)
            //call.
            //==========================================================================================================
            //$table->integer('ordering')
            //      ->default(0)
            //      ->comment = 'Used to determine the ordering shown in drop down boxes, lists, etc.';

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
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_types');
    }
}
