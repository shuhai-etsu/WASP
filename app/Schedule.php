<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class Schedule extends Model
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
    protected $fillable = ['abbreviation',
                           'description',
                           'semester_id',
                           'classroom_id',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entries()
    {
        return $this->hasMany(ScheduleEntry::class);
    }

    public function semester()
    {
        return $this->hasOne(Semester::class, 'id', 'semester_id');
    }

    public function classroom()
    {
        return $this->hasOne(Classroom::class, 'id', 'classroom_id');
    }
}
