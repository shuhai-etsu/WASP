<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * Class UserEducationalAchievement
 * @package App
 */
class UserEducationHistory extends Model
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
    protected $fillable = ['user_id',
                           'institution',
                           'type_id',
                           'graduation_date',
                           'comment'];

    protected $dates = ['graduation_date',
                        'created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string Name of the table associated with the model
     */
    protected $table = 'user_education_history';

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
    public function type()
    {
        return $this->hasOne(DegreeType::class, 'id', 'type_id');
    }
}
