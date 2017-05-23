<?php

use Illuminate\Database\Seeder;


/**
 * Class: DatabaseSeeder
 *
 * Purpose: Seeds the database with data by calling individual seeders that insert data into specific tables.
 *
 * Notes: None
 *
 * Modification History:
 *
 *      Developer           Date            Description
 *      ----------------------------------------------------------------------------------------------------------------
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Run the database seeds.
     *
     * @todo document ordering dependencies amongst seeding operations
     * @todo drop seeding of buildings table, genders table, and (probably) philosophy types table
     *
     * @return void
     */
    public function run()
    {
        try
        {
            $this->call(AgeGroupTypesTableSeeder::class);
            $this->call(DegreeTypesTableSeeder::class);
            $this->call(TitleTableSeeder::class);
            $this->call(CertificationTypesTableSeeder::class);
            $this->call(FinancialAidTypesTableSeeder::class);
            $this->call(CountriesTableSeeder::class);
            $this->call(WorkStatusTypesTableSeeder::class);
            $this->call(GendersTableSeeder::class);
            $this->call(RelationshipTypesTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(StatesTableSeeder::class);
            $this->call(SuffixesTableSeeder::class);
            $this->call(TelephoneTypesTableSeeder::class);
            $this->call(UserStatusTypesTableSeeder::class);
            $this->call(WeekdaysTableSeeder::class);
            $this->call(BusinessHoursTableSeeder::class);
            $this->call(BuildingsTableSeeder::class);
            $this->call(SemestersTableSeeder::class);
            $this->call(ClassroomsTableSeeder::class);
            $this->call(SecurityPrivilegeTypesTableSeeder::class);
            $this->call(PhilosophyTypesTableSeeder::class);
            $this->call(ConstraintsTableSeeder::class);
            $this->call(ChecklistItemsSeeder::class);
            $this->call(DocumentTypesSeeder::class);

            //==========================================================================================================
            //@ToDo Edit the default seeder files and add Little Bucs/CSC personnel for production database.
            //==========================================================================================================
            $this->call(UserTableSeeder::class);

            //Removed based upon client comments
            //$this->call(UserEmailAddressSeeder::class);
      
            //==========================================================================================================
            //Insert fake data for testing purposes.
            //==========================================================================================================
            $this->call(FakeUserTableSeeder::class);

            //Removed base upon client comments
            //$this->call(FakeUserEmailAddressSeeder::class);

            $this->call(FakeUserTelephonesSeeder::class);
            $this->call(FakeUserAddressTableSeeder::class);
            $this->call(FakeUserAvailabilitesSeeder::class);
            $this->call(FakeUserCertificationsSeeder::class);
            $this->call(FakeUserClassroomAssignmentsSeeder::class);
            $this->call(FakeFinancialAidSeeder::class);
        }
        catch(Exception $e)
        {
            echo "The following error occurred while attempting to seed the database: " . $e->getMessage();
        }
    }
}
