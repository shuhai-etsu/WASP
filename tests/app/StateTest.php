<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\State; //include a reference to the State model since we will be using it in our test.


/**
 * Class: StateTest
 *
 * Purpose: Class is used to test the validity of State objects returned from Eloquent, specifically if the given State
 *          object has a valid abbreviation and description. Class assumes the database has been pre-populated with
 *          valid state data, such as TN or Tennessee.
 *
 * Notes: The DatabaseTransactions clause ensures tests that create objects (e.g. table entries) are rolled back
 *        after the transaction completes, ensuring the database returns to its previous state. Otherwise the
 *        test data would remain in the database after the test completed.
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
class StateTest extends TestCase
{
    use DatabaseTransactions;    //See note above

    /**
     * Function: has_an_abbreviation()
     *
     * Purpose: Test checks to see if a given State's abbreviation exists in the database.
     *
     * @test
     *
     * @return void
     */
    function has_an_abbreviation()
    {
        $this->seeInDatabase('states', ['abbreviation' => 'TN']);
    }

    /**
     * Function: has_a_description()
     *
     * Purpose: Test checks to see if a given State's description exists in the database.
     *
     * @test
     *
     * @return void
     */
    function has_a_description()
    {
        $this->seeInDatabase('states', ['description' => 'Tennessee']);
    }

    /**
     * Function: insert_duplicate_entry()
     *
     * Purpose: Test checks to see if a duplicate entry can be inserted into the database, which violates the UNIQUE
     *          constraints set on the abbreviation and description fields. Test should
     *          generate a SQL integrity violation error.
     *
     * @test
     *
     * @return void
     */
    function insert_duplicate_entry()
    {
       /* factory(App\State::class, 1)->create();*/
    }

    /**
     * Function: insert_entry_with_duplicate_lowercase_abbreviation()
     *
     * Purpose: Test checks to see if a duplicate lowercase abbreviation can be stored in the the database. Test
     *          determines if the UNIQUE constraint set on the abbreviation column will be violated. Test should
     *          generate a SQL integrity violation error.
     *
     * @test
     *
     * @return void
     */
    function insert_entry_with_duplicate_lowercase_abbreviation()
    {
       /* factory(App\State::class, 1)->create(['abbreviation' => 'tn',
                                              'description' => 'tennessee_']);*/
    }

    /**
     * Function: insert_entry_with_duplicate_lowercase_description()
     *
     * Purpose: Test checks to see if a duplicate lowercase description can be stored in the the database. Test
     *          determines if the UNIQUE constraint set on the description column will be violated. Test should
     *          generate a SQL integrity violation error.
     *
     * @test
     *
     * @return void
     */
    function insert_entry_with_duplicate_lowercase_description()
    {
        /*factory(App\State::class, 1)->create(['abbreviation' => 'tn_',
                                              'description' => 'tennessee']);*/
    }
}
