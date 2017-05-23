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
 */
class UserAvailability extends Model
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
                           'semester_id',
                           'weekday_id',
                           'start_time',
                           'end_time',
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
    public function semester()
    {
        return $this->hasOne(Semester::class, 'id', 'semester_id');
    }

    /**
     * @todo add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function weekday()
    {
        return $this->hasOne(Weekday::class, 'id', 'weekday_id');
    }
}
