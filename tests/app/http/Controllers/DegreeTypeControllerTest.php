<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class DegreeTypeControllerTest extends TestCase
{
    /*@test*/
    public function test_AllDegreeTypesAreListedInPage()
    {
        $this->get('/api/degree_types');
    }

    /*@test*/
    public function test_NewDegreeTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/degree_types')
            ->see('Degree Types')
            ->click("#degree_id")//use id for the link i.e. New Degree
            ->seePageIs('degree_types/create')
            ->see('Add Degree Types')
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test degree', 'comment')
            ->see('Save')
            ->see("For Example: Graduate")
            ->press('Save')
            ->get(route('degree_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/degree_types')
            ->see('test');
    }


    /*@test*/
    public function test_ADegreeCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/degree_types')
            ->see('Degree Types')
            ->click('Edit')
            ->seePageIs('/degree_types/4/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('degree_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/degree_types')
            ->see('AS');
    }
}
