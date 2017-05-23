<?php

use Illuminate\Database\Seeder;

use App\User;
use App\FinancialAidType;
use App\UserFinancialAid;

/**
 * Class FakeFinancialAidSeeder
 *
 * @todo - add class header comment
 */

class FakeFinancialAidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Preconditions:
     * -.  assumes FinancialAidType table was initialized
     * -.  assumes initial entry in FinancialAidType can be ignored
     *
     * @todo more explanation would help: e.g., why every fifth user, reather than every user?
     *
     * @return void
     */
    public function run()
    {
        $count = 0;
        $users = User::all();
        $types = FinancialAidType::where('id', '>', 1)->get();

        foreach ($users as $user)
        {
            if(($count % 5) == 0)
            {
                $index = rand(1, (count($types) - 1));
                $type = $types[$index];

                $obj = new UserFinancialAid;

                $obj->user_id = $user->id;
                $obj->type_id = $type->id;

                $obj->save();
            }

            $count++;
        }
    }
}
