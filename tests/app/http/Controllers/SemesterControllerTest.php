<?php

use App\Http\Controllers\SemesterController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class SemesterControllerTest extends TestCase
{
    /*@test*/
    public function test_AllSemesterTypesAreListedInPage()
    {
        $this->get('/api/semesters');
    }

    /*@test*/
    public function test_NewSemesterTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/semesters')
            ->see('Semesters')
            ->click("#semesters_id")//use id for the link i.e. New Semester
            ->seePageIs('semesters/create')
            ->see('Add Semester')
            ->see('Save')
            ->see("For Example: Fall 2017")
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('2016-08-01', 'start_date')
            ->type('2016-12-10','end_date')
            ->type('This is a test semester', 'comment')
            ->press('Save')
            ->get(route('semesters.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/semesters')
            ->see('test');
    }


    /*@test*/
    public function test_ASemesterCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/semesters')
            ->see('Semesters')
            ->click('Edit')
            ->seePageIs('/semesters/2/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('semesters.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/semesters')
            ->see('AS');
    }
}

