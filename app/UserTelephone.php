<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


class UserTelephone extends Model
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
    protected $fillable = ['type_id',
                           'user_id',
                           'telephone_number',
                           'comment',
                           'is_primary'];

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
    public function type()
    {
        return $this->hasOne(TelephoneType::class, 'id', 'type_id');
    }
}
