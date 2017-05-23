<?php

use App\Http\Controllers\FinancialAidTypeController;
use App\User;


class FinancialAidTypeControllerTest extends TestCase
{
    /*@test*/
    public function test_AllFinancial_aid_typesAreListedInPage()
{
    $this->get('/api/financial_aid_types');
}

/*@test*/
public function test_AFinancial_aid_typesCanBeEdited()
{
$user = User::find(5);
    $this->be($user);
    $this->visit('/financial_aid_types')
        ->see('/financial_aid_types')
        ->click('Edit')
        ->seePageIs('/financial_aid_types/2/edit')
        ->type('CPRS','abbreviation')
        ->press('Save')
        ->get(route('financial_aid_types.store'))
        ->assertResponseStatus(200)
        ->seePageIs('/financial_aid_types')
        ->see('CPRS');
}

/*@test*/
public function test_NewFinancial_aid_typesTypeCanBeCreated()
{
$user = User::find(5);
    $this->be($user);
    $this
        ->visit('/financial_aid_types')
        ->see('/financial_aid_types')
        ->click("#financial_aid_types_id")//use id for the link i.e. /financial_aid_types Type
        ->seePageIs('/financial_aid_types/create')
        ->see('Add Financial Aid Type')
        ->see('Save')
        ->see("For Example: APS")
        ->type('Test Financial', 'description')
        ->type('TF', 'abbreviation')
        ->type('10','max_hours')
        ->type('This is a test financial_aid_types type', 'comment')
        ->press('Save')
        ->get(route('financial_aid_types.store'))
        ->assertResponseStatus(200)
        ->seePageIs('/financial_aid_types')
        ->see('Test Financial');
}


}
