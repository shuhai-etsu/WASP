<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesTest extends TestCase
{
    use DatabaseTransactions;     //See note above

    /**
     * Function: has_an_abbreviation()
     *
     * Purpose: Test checks to see if a given Role's abbreviation exists in the database.
     *
     * @test
     *
     * @return void
     *
     * Modification History:
     *
     *      Developer           Date            Description
     *      ------------------------------------------------------------------------------------------------------------
     */
    function has_an_abbreviation()
    {
        $this->seeInDatabase('roles', ['abbreviation' => 'A']);
    }

    /**
     * Function: has_a_description()
     *
     * Purpose: Test checks to see if a given Role's description exists in the database.
     *
     * @test
     *
     * @return void
     */
    function has_a_description()
    {
        $this->seeInDatabase('roles', ['description' => 'Administrator']);
    }
}
