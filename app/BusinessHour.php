<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * Class BusinessHour
 * @todo add class description as header comment
 */
class BusinessHour extends Model
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
    protected $fillable = ['weekday_id',
                           'start_time',
                           'end_time',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    public function scopeWeekday()
    {
        return $this->belongsTo(Weekday::class);
    }
}
