<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


/**
 * Class:
 *
 * Purpose:
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class UserEmergencyContact extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /**
     * @todo add header comments
     *
     * Identify the items that can be mass assigned or changed.
     */
    protected $fillable = ['user_id',
                           'first_name',
                           'middle_name',
                           'last_name',
                           'relationship_id',
                           'telephone_number',
                           'email',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * @todo add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @todo add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    /**
     * @todo add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function relationship()
    {
        return $this->hasOne(Relationship::class, 'id', 'relationship_id');
    }
}
