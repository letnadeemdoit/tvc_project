<?php

namespace Database\Seeders;

use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MigrateOldAccountsPhotosToDefaultAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where([
            'role' => User::ROLE_ADMINISTRATOR,
            'primary_account' => 1,
        ])->chunk(100, function ($users) {
            foreach ($users as $user) {
                $album = Album::create([
                    'house_id' => $user->HouseId,
                    'user_id' => $user->user_id,
                    'name' => 'Default',
                ]);

                Photo::where([
                    'HouseId' => $user->HouseId,
                    'album_id' => 0,
                ])->update([
                    'album_id' => $album->id
                ]);
            }
        });
    }
}
