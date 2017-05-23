<?php
use App\Http\Controllers\ClassroomController;
use App\User;


class ClassroomControllerTest extends TestCase
{
    /*@test*/
    public function test_AllClassroomsAreListedInPage()
    {
        $this->get('/api/classrooms');
    }

    /*@test*/
    public function test_AClassroomsCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/classrooms')
            ->see('Classrooms')
            ->click('Edit')
            ->seePageIs('classrooms/2/edit')
            ->type('CPRS','abbreviation')
            ->press('Save')
            ->get(route('classrooms.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/classrooms')
            ->see('CPRS');
    }

    /*@test*/
    public function test_NewClassroomsTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/classrooms')
            ->see('Classrooms')
            ->click("#classroom_id")//use id for the link i.e. Classrooms Type
            ->seePageIs('classrooms/create')
            ->see('Add Classroom')
            ->see('Save')
            ->see("For Example: Butterfly")
            ->type('CutiePie', 'description')
            ->type('CP', 'abbreviation')
            ->type('This is a test classrooms type', 'comment')
            ->type('3','minimum_students')
            ->type('10','maximum_students')
            ->press('Save')
            ->get(route('classrooms.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/classrooms')
            ->see('CutiePie');
    }
}

