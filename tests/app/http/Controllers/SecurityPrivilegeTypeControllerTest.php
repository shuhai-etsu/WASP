<?php

use App\Http\Controllers\SecurityPrivilegeTypeController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class SecurityPrivilegeTypeControllerTest extends TestCase
{
    /*@test*/
    public function test_AllSecurityPrivilegeTypesAreListedInPage()
    {
        $this->get('/api/security_privilege_types');
    }

    /*@test*/
    public function test_NewSecurityPrivilegeTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/security_privilege_types')
            ->see('Security Privilege')
            ->click("#security_privilege_types_id")//use id for the link i.e. New SecurityPrivilege
            ->seePageIs('security_privilege_types/create')
            ->see('Add Security Privilege')
            ->see('Save')
            ->see("For Example: AUDU")
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test work_status_type', 'comment')
            ->press('Save')
            ->get(route('security_privilege_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/security_privilege_types')
            ->see('test');
    }


    /*@test*/
    public function test_ASecurityPrivilegeCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/security_privilege_types')
            ->see('Security Privilege')
            ->click('Edit')
            ->seePageIs('/security_privilege_types/18/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('security_privilege_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/security_privilege_types')
            ->see('AS');
    }
}

