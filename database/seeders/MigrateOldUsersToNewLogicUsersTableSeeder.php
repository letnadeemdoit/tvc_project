<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MigrateOldUsersToNewLogicUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('primary_account', 0)
            ->where('role', User::ROLE_ADMINISTRATOR)
            ->groupBy('email', 'user_id')
            ->get();
        foreach ($users as $user) {
            $user->update([
                'primary_account' => 1
            ]);

            User::where('HouseId', $user->HouseId)
                ->whereNot('user_id', $user->user_id)
                ->update(['parent_id' => $user->user_id]);
        }
    }
}
