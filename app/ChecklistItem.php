<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
/**
 * Class: ChecklistItem
 *
 * Purpose: Class stores information associated with a given CheckList Item. An checklist document type is typically
 *          used to get users signature for acceptance of the document. For instance.
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */

class ChecklistItem extends Model
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
    protected $fillable = ['name',
        'description',
        'comment',
        'default_selection'];

    protected $dates = ['created_at',
        'updated_at',
        'deleted_at'];

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userSignedDocuments()
    {
        return $this->hasMany(UserChecklistItem::class);
    }
}
