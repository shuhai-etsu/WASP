<?php


use App\Http\Controllers\SuffixController;
use App\User;


class SuffixControllerTest extends TestCase
{
    /*@test*/
    public function test_AllSuffixTypesAreListedInPage()
    {
        $this->get('/api/suffixes');
    }

    /*@test*/
    public function test_NewSuffixTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/suffixes')
            ->see('Suffix')
            ->click("#suffixes_id")//use id for the link i.e. New Suffix
            ->seePageIs('suffixes/create')
            ->see('Add Suffix')
            ->see('Save')
            ->see("For Example: Junior")
            ->type('test', 'description')
            ->type('T', 'abbreviation')
            ->type('This is a test suffix', 'comment')
            ->press('Save')
            ->get(route('suffixes.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/suffixes')
            ->see('test');
    }


    /*@test*/
    public function test_ASuffixCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/suffixes')
            ->see('Suffix')
            ->click('Edit')
            ->seePageIs('/suffixes/4/edit')
            ->type('AS','abbreviation')
            ->press('Save')
            ->get(route('suffixes.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/suffixes')
            ->see('AS');
    }
}
