<?php

namespace Database\Seeders;

use App\Models\Vacation;
use App\Models\User;
use Illuminate\Database\Seeder;

class UpdateVacationOwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vacation::where('OwnerId', 0)->chunk(100, function ($vacations) {
            foreach ($vacations as $vacation) {
                $houseId = $vacation->HouseId;

                $adminUser = User::where('HouseId', $houseId)
                    ->where('role', 'Administrator')
                    ->first();

                if ($adminUser) {
                    $vacation->OwnerId = $adminUser->user_id;
                    $vacation->save();
                }
            }
        });
    }
}
