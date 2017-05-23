<?php

use App\Http\Controllers\WorkStatusTypeController;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class WorkStatusTypeControllerTest extends TestCase
{
    /*@test*/
    public function test_AllWorkStatusTypesAreListedInPage()
    {
        $this->get('/api/work_status_types');
    }

    /*@test*/
    public function test_NewWorkStatusTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/work_status_types')
            ->see('Work Status')
            ->click("#work_status_types_id")//use id for the link i.e. New WorkStatus
            ->seePageIs('work_status_types/create')
            ->see('Add Work Status')
            ->see('Save')
            ->see("For Example: A")
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test work_status_type', 'comment')
            ->press('Save')
            ->get(route('work_status_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/work_status_types')
            ->see('test');
    }


    /*@test*/
    public function test_AWorkStatusCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/work_status_types')
            ->see('Work Status')
            ->click('Edit')
            ->seePageIs('/work_status_types/2/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('work_status_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/work_status_types')
            ->see('AS');
    }
}

