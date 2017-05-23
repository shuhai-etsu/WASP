<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use OwenIt\Auditing\Auditable;


/**
 * Class:
 *
 * Purpose:
 *
 * Notes: Uses the Auditable trait for tracking user changes (inserts, updates, deletes).
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 * @todo - clean up commented out code
 */
class User extends Authenticatable
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
     * @todo - eliminate gender and alternate_email from the table, since both are being deprecated
     *
     * @var array
     */
    protected $fillable = [//'title_id',
                           'enumber',
                           'first_name',
                           'middle_name',
                           'last_name',
                           'suffix_id',
                           'role_id',
                           'email',
                           'alternate_email',
                           'user_status_id',
                           'password'];

    protected $dates = ['created_at',
                        'updated_at',
                        'deleted_at'];

    /*
    public static  $rules = array
    (
        'first_name' => 'required',
        'last_name'  => 'required',
        'gender_id' => 'required',
        'email' => 'required|email'
    );
    */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * @todo - add header comments
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name .
                      (!is_null($this->middle_name )? ' ' . $this->middle_name . ' ' : ' ') .
                      $this->last_name;
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Check if this user belongs to a role
     * @param $role_id integer
     * @return bool
     */
    public function hasRole($role_id)
    {
        return $this->role_id == $role_id;
    }

    /**
     * Check if this user has the specified status
     * @param $user_status_id integer
     * @return bool
     */
    public function hasStatus($user_status_id)
    {
        return $this->user_status_id == $user_status_id;
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function suffix()
    {
        return $this->hasOne(Suffix::class, 'id', 'suffix_id');
    }

    /**
     * DEPRECATED
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /*public function title()
    {
        return $this->hasOne(Title::class, 'id', 'title_id');
    }*/

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telephones()
    {
        return $this->hasMany(UserTelephone::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emergencyContacts()
    {
        return $this->hasMany(UserEmergencyContact::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availabilities()
    {
        return $this->hasMany(UserAvailability::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certifications()
    {
        return $this->hasMany(UserCertification::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classroomAssignments()
    {
        return $this->hasMany(ClassroomAssignment::class);
    }

    //Needs to be changed to Role, which has security types

    /**
     * @todo - change to role; add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function securityPrivileges()
    {
       return $this->hasMany(UserSecurityPrivilege::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function philosophies()
    {
        return $this->hasMany(UserPhilosophy::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references()
    {
        return $this->hasMany(UserReference::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financialAid()
    {
        return $this->hasMany(UserFinancialAid::class);
    }

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function education()
    {
        return $this->hasMany(UserEducationHistory::class);
    }   
    
    //DEPRECATED
    /*
    public function alternateEmailAddresses()
    {
        return $this->hasMany(UserEmailAddress::class);
    }
    */

    /**
     * @todo - add header comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userSignedChecklistDocuments()
    {
        return $this->hasMany(UserChecklistDocument::class);
    }
}
