<?php
/**
 * Created by PhpStorm.
 * User: sumnima
 * Date: 3/25/2017
 * Time: 7:03 PM
 */


use App\Http\Controllers\CertificationTypeController;
use App\User;


class CertificationTypeControllerTest extends TestCase
{
    /*@test*/
    public function test_AllCertificationAreListedInPage()
    {
        $this->get('/api/certification_types');
    }

    /*@test*/
    public function test_ACertificationCanBeEdited()
    {
        $user = User::find(5);
        $this->be($user);
        $this->visit('/certification_types')
            ->see('Certification')
            ->click('Edit')
            ->seePageIs('certification_types/3/edit')
            ->type('CPRS','abbreviation')
            ->press('Save')
            ->get(route('certification_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/certification_types')
            ->see('CPRS');
    }

    /*@test*/
    public function test_NewCertificationTypeCanBeCreated()
    {
        $user = User::find(5);
        $this->be($user);
        $this
            ->visit('/certification_types')
            ->see('Certification')
            ->click("#certification_types_id")//use id for the link i.e. Certification Type
            ->seePageIs('certification_types/create')
            ->see('Add Certification')
            ->see('Save')
            ->see("For Example: FA")
            ->type('Cert', 'description')
            ->type('C', 'abbreviation')
            ->type('This is a test certification type', 'comment')
            ->press('Save')
            ->get(route('certification_types.store'))
            ->assertResponseStatus(200)
            ->seePageIs('/certification_types')
            ->see('Cert');
    }

}
