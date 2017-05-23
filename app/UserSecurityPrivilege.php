<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;


class UserSecurityPrivilege extends Model
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
                           'security_privilege_type_id',
                           'comment'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * @todo need header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @todo need header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function securityPrivilege()
    {
        return $this->hasOne(SecurityPrivilegeType::class, 'id', 'security_privilege_type_id');
    }
}
