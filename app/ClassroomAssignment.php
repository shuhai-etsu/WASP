<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


/**
 * Class ClassroomAssignment
 * @todo add class description as header comment
 */

class ClassroomAssignment extends Model
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
    protected $fillable = ['semester_id',
                           'classroom_id',
                           'user_id',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
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
