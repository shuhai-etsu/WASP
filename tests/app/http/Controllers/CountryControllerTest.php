<?php

use App\Http\Controllers\CountryController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class CountryControllerTest extends TestCase
{
    /*@test*/
    public function test_AllCountryTypesAreListedInPage()
    {
        $this->get('/api/countries');
    }

    /*@test*/
    public function test_NewCountryTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/countries')
            ->see('Countries')
            ->click("#countries_id")//use id for the link i.e. New Country
            ->seePageIs('countries/create')
            ->see('Add Country')
            ->see('Save')
            ->see("For Example: USA")
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test country', 'comment')
            ->press('Save')
            ->get(route('countries.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/countries')
            ->see('test');
    }


    /*@test*/
    public function test_ACountryCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/countries')
            ->see('Countries')
            ->click('Edit')
            ->seePageIs('/countries/2/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('countries.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/countries')
            ->see('AS');
    }
}

