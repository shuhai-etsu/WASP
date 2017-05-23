<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


/**
 * Class ClassroomAttendance
 * @todo add class description as header comment
 */

class ClassroomAttendance extends Model
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
    protected $fillable = ['user_id',
                           'day',
                           'semester_id',
                           'classroom_id',
                           'total_students',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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
