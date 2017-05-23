<?php
/**
 * Created by PhpStorm.
 * User: sumnima
 * Date: 3/26/2017
 * Time: 2:30 AM
 */


use App\Http\Controllers\RoleController;
use App\User;


class RoleControllerTest extends TestCase
{
    /*@test*/
    public function test_AllRoleTypesAreListedInPage()
    {
        $this->get('/api/roles');
    }

    /*@test*/
    public function test_NewRoleTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/roles')
            ->see('Role')
            ->click("#roles_id")//use id for the link i.e. New Role
            ->seePageIs('roles/create')
            ->see('Add Role')
            ->see('Save')
            ->see("For Example: Administrator")
            ->type('ZTest', 'description')
            ->type('Z', 'abbreviation')
            ->type('This is a test role', 'comment')
            ->press('Save')
            ->get(route('roles.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/roles')
            ->see('ZTest');
    }


    /*@test*/
    public function test_ARoleCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/roles')
            ->see('Role')
            ->click('Edit')
            ->seePageIs('/roles/3/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('roles.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/roles')
            ->see('AS');
    }


}
