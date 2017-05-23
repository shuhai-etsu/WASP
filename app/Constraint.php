<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * Class: Constraint
 *
 * Purpose: Class stores information associated with a given Constraint.
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * @todo finish documenting this class; explain what's meant by "constraint"
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class Constraint extends Model
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
                           'comment',
                           'default_selection'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];
}
