<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateChecklistItems
 *
 * Purpose: The class is used to create and drop signable items from checklist. This stores information on the
 *          items that need to be signed by the user before being employed by CAS/LB
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

class CreateChecklistItems extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     *
     * @todo Consider how to adjust the table structure, if necessary, to support nested entries. See ordering notes
     * below.
     */

    public function up()
    {
        Schema::create('checklist_items', function (Blueprint $table)
        {
            $table->increments('id')
                ->comment = 'Primary key.';

            $table->string('name', 50)
                ->unique()
                ->comment = 'Name of the signable document item';

            $table->string('description', 1000)
                ->nullable()
                ->comment = 'Detailed description of the item. This is the body of the document';

            $table->string('comment', 255)
                ->nullable()
                ->comment = 'Brief comment about the given age group type entry.';

            $table->boolean('enabled')
                ->default(true)
                ->comment = 'Determines if the entry is enabled or disabled.';

            $table->boolean('default_selection')
                ->default(false)
                ->comment = 'Determines if the entry should be shown as the default selection in UI controls.';
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
        Schema::dropIfExists('checklist_items');
    }
}
