<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


class ScheduleEntry extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /**
     * Identify the items that can be mass assigned or changed.
     */
    protected $fillable = ['schedule_id',
                           'user_id',
                           'day',
                           'start_time',
                           'end_time',
                           'background_color',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];


    /**
     * The table associated with the model.
     *
     * @var string Name of the table associated with the model
     */
    protected $table = 'schedule_entries';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function weekday()
    {
        return $this->belongsTo(Weekday::class);
    }
}
