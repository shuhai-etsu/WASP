<?php

use Illuminate\Foundation\Testing\DatabaseTransactions; //see note below

/**
 * Class: UserStatusTypeTest
 *
 * Purpose: Class is used to test the validity of UserStatusType objects returned from Eloquent, specifically if the
 *          given UserStatusType object has a valid abbreviation and description. Class assumes the database has been
 *          pre-populated with valid User Status Type data.
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
class UserStatusTypeTest extends TestCase
{
    use DatabaseTransactions;   //See note above

    /**
     * Function: has_an_abbreviation()
     *
     * Purpose: Test checks to see if a given UserStatusType's abbreviation exists in the database.
     *
     * @test
     */
    function has_an_abbreviation()
    {
        $this->seeInDatabase('user_status_types', ['abbreviation' => 'A']);
    }

    /**
     * Function: has_a_description()
     *
     * Purpose: Test checks to see if a given UserStatusType's description exists in the database.
     *
     * @test
     *
     * @return void
     */
    function has_a_description()
    {
        $this->seeInDatabase('user_status_types', ['description' => 'Active']);
    }
}