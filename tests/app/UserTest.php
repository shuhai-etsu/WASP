<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class: UserTest
 *
 * Purpose: Class is used to test the validity of Users objects returned from Eloquent, specifically if the
 *          given User object has a exists in the database. Class assumes the database has been pre-populated with valid
 *          data.
 *
 * Notes: The DatabaseTransactions clause ensures any future tests that create Relationship objects are rolled back
 *        after the transaction completes, ensuring the database is returned to its previous state.
 *
 *        PHPUnit requires tests to begin with the word "test." However this can be circumvented using the "@test"
 *        annotation. Annotations are used in this class.
 *
 *        Class does not follow PHP recommendations for function names (e.g. using camel case). Function names are
 *        delimited by underscores "_" for readability purposes.
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * Modification History:
 *
 *      Developer           Date            Description
 *      ----------------------------------------------------------------------------------------------------------------
 */
class UserTest extends TestCase
{
    use DatabaseTransactions;   //see note above
    
    /**
     * Function: fetch_user()
     *
     * Purpose: Test checks to see if a given user, based upon first name and last name, exists in the database.
     *
     * @test
     *
     * @return void
     */
    public function fetch_user()
    {
        $this->seeInDatabase('users', ['first_name' => 'David',
                                       'last_name' => 'Bishop']);
    }
    
    public function has_addresss()
    {
        $this->assertTrue(true);
    }  
    
    public function has_telephone_number()
    {
        $this->assertTrue(true);
    }    
    
}
