<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


/**
 * Class: Relationship
 *
 * Purpose: Class stores information associated with relationships. The information is typically used to
 *          determine the relationship of an emergency contact for a given user, such as Mother, Father, etc. The
 *          information is typically shown in drop down/pick lists and in reports.
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class Relationship extends Model
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
