<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

use App\Classroom;

/**
 * Class Semester
 * @package App
 */
class Semester extends Model
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
    protected $fillable = ['abbreviation',
                           'description',
                           'time_increment',
                           'start_date',
                           'end_date',
                           'enabled',
                           'comment'];
    
    protected $dates = ['start_date',
                        'end_date',
                        'created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * @todo need header comment
     *
     * @param $date
     */
    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * @todo need header comment
     *
     * @param $date
     */
    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /*
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    */
}
