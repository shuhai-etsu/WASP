<?php


use App\Http\Controllers\TelephoneTypeController;
use App\User;


class TelephoneTypeControllerTest extends TestCase
{
    /*@test*/
    public function test_AllTelephoneTypesAreListedInPage()
    {
        $this->get('/api/telephone_types');
    }

    /*@test*/
    public function test_NewTelephoneTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/telephone_types')
            ->see('Telephone')
            ->click("#telephone_types_id")//use id for the link i.e. New Telephone
            ->seePageIs('telephone_types/create')
            ->see('Add Telephone')
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test telephone', 'comment')
            ->see('Save')
            ->see("For Example: Mobile")
            ->press('Save')
            ->get(route('telephone_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/telephone_types')
            ->see('test');
    }

    /*@test*/
    public function test_ATelephoneCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/telephone_types')
            ->see('Telephone')
            ->click('Edit')
            ->seePageIs('/telephone_types/2/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('telephone_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/telephone_types')
            ->see('AS');
    }
}
