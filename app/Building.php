<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * Class:
 *
 * Purpose:
 *
 * Notes:
 *
 * Requirement(s):
 *
 * @todo remove from code base, since buildings won't be tracked?  or, at least, move to a folder for deprecated code.
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class Building extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /**
     * Items that can be mass assigned by the user.
     *
     * @var array Array that contains the list of fields that can be mass assigned.
     */
    protected $fillable = ['abbreviation',
                           'description',
                           'address1',
                           'address2',
                           'city',
                           'state_id',
                           'zipcode',
                           'comment',
                           'default_selection'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
