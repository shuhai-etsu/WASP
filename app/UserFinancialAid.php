<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;

class UserFinancialAid extends Model
{
    use Auditable;

    /**
     * Item(s) that should not be changed by the user, such as the primary key value (e.g. id) of a given entry
     *
     * @var array Array containing a list of items that should not be changed by the user.
     */
    protected $guarded = array('id');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id',
                           'type_id',
                           'comment'];
    
    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string Name of the table associated with the model
     */
    protected $table = 'user_financial_aid';

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
        return $this->hasOne(FinancialAid::class, 'id', 'type_id');
    }
}
