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
 * @todo - finish header comments; clean up commented code
 *
 */
class UserAddress extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /*
    public static $rules = array
    (
        'address1' => 'required',
        'city' => 'required',
        'state_id' => 'required',
        'zipcode' => 'required'
    );
    */
    

    /**
     * Identify the items that can be mass assigned or changed.
     */
    protected $fillable = ['user_id',
                           'address1',
                           'address2',
                           'city',
                           'state_id',
                           'country_id',
                           'zipcode',
                           'is_primary',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * @todo - add header comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @todo - add header comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    /**
     * @todo - add header comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

}
