<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

use Carbon\Carbon;

/**
 * Class UserCertification
 * @package App
 */
class UserCertification extends Model
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
                           'certification_id',
                           'date_certified',
                           'expiration_date',
                           'comment'];
  
    protected $dates = ['date_certified',
                        'expiration_date',
                        'created_at',
                        'updated_at',
                        'deleted_at'];

    /**
     * @todo add header comments
     *
     * @param $date
     */
    public function setDateCertifiedAttribute($date)
    {
        $this->attributes['date_certified'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * @todo add header comments
     *
     * @param $date
     */
    public function setExpirationDateAttribute($date)
    {
        $this->attributes['expiration_date'] = Carbon::createFromFormat('Y-m-d', $date);
    }

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
    public function certification()
    {
        return $this->hasOne(CertificationType::class, 'id', 'certification_id');
    }
}
