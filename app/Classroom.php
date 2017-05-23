<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


/**
 * Class: Classroom
 *
 * Purpose: Model that contains classroom data that is stored or retrieved from the database.
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class Classroom extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /**
     * Items that can be mass assigned or changed by the user.
     */
    protected $fillable = ['abbreviation',
                           'description',
                           'minimum_students',
                           'maximum_students',
                           //'room',
                           //'building_id',
                           'comment',
                           'default_selection'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * Method: building()
     *
     * Purpose: Creates the linkages between a class and its corresponding building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Create the linkages back to a specific building since
     * buildings can have multiple classrooms.
     */
    /*
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    */
}
