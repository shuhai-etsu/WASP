<?php
use App\Http\Controllers\AgeGroupTypeController;
use App\User;


class AgeGroupTypeControllerTest extends TestCase
{

    /*@test*/
    public function test_AllAgeGroupAreListedInPage()
    {
        $this->get('/api/age_group_types');
    }

    /*@test*/
    public function test_ADegreeCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/age_group_types')
            ->see('Age Group')
            ->click('Edit')
            ->seePageIs('age_group_types/2/edit')
            ->type('A','abbreviation')
            ->press('Save')
            ->get(route('age_group_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/age_group_types')
            ->see('A');
    }

    /*@test*/
    public function test_NewAgeGroupTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/age_group_types')
            ->see('Age Group')
            ->click("#age_group_type_id")//use id for the link i.e. Age Group Type
            ->seePageIs('age_group_types/create')
            ->see('Add Age Group')
            ->see('Save')
            ->see("For Example: I")
            ->type('Big', 'description')
            ->type('B', 'abbreviation')
            ->type('This is a test age group type', 'comment')
            ->press('Save')
            ->get(route('age_group_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/age_group_types')
            ->see('Big');
    }
}
