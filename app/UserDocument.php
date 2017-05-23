<?php

namespace App;
use OwenIt\Auditing\Auditable;


use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
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
        'name',
        'filename',
        'comments',
        'expiration_date'];

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
        return $this->hasOne(DocumentType::class, 'id', 'type_id');
    }
}
