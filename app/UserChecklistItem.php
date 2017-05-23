<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use Carbon\Carbon;

/**
 * Class UserChecklistItem
 * @package App
 */

class UserChecklistItem extends Model
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
        'document_id',
        'date_signed'];

    protected $dates = ['date_signed',
        'created_at',
        'updated_at',
        'deleted_at'];

    /**
     * @todo add header comments
     *
     * @param $date
     */
    public function setDateSignedAttribute($date)
    {
        $this->attributes['date_signed'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
    * @todo - add header comments
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document()
    {
        return $this->belongsTo(ChecklistItem::class);
    }
}
