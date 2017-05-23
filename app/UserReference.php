<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;

/**
 * Class: UserReference
 *
 * Purpose: Class stores employment references for a given user. The employment references are part of the
 * application process when a potential employee applies to Little Buc's or the CSC for employment purposes.
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class UserReference extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id',
                           'first_name',
                           'middle_name',
                           'last_name',
                           'telephone_number',
                           'type_id',
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
    public function telephoneType()
    {
        return $this->hasOne(TelephoneType::class, 'id', 'type_id');
    }
}
