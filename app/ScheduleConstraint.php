<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class ScheduleConstraint extends Model
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
    protected $fillable = ['schedule_id',
                           'constraint_id',
                           'comment',
                           'default_selection'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];


    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function constraint()
    {
        return $this->hasOne(ScheduleConstraintType::class, 'id', 'constraint_id');
    }
}
