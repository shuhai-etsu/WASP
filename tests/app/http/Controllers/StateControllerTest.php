<?php

use App\Http\Controllers\StateController;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class StateControllerTest extends TestCase
{
    /*@test*/
    public function test_AllStateTypesAreListedInPage()
    {
        $this->get('/api/states');
    }

    /*@test*/
    public function test_NewStateTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/states')
            ->see('States')
            ->click("#states_id")//use id for the link i.e. New State
            ->seePageIs('states/create')
            ->see('Add State')
            ->see('Save')
            ->see("For Example: TN.")
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test state', 'comment')
            ->press('Save')
            ->get(route('states.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/states')
            ->see('test');
    }


    /*@test*/
    public function test_AStateCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/states')
            ->see('States')
            ->click('Edit')
            ->seePageIs('/states/2/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('states.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/states')
            ->see('AS');
    }
}

