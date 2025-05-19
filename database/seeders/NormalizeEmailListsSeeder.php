<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;

class NormalizeEmailListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // All the email‐list columns on the houses table
        $columns = [
            'CalEmailList',
            'vacation_approval_email_list',
            'BlogEmailList',
            'request_to_use_house_email_list',
            'local_guide_email_list',
            'guest_book_email_list',
            'photo_email_list',
            'food_item_list',
        ];

        // Use chunkById on your custom PK
        House::chunkById(100, function ($houses) use ($columns) {
            foreach ($houses as $house) {
                $dirty = false;

                foreach ($columns as $col) {
                    $value = $house->{$col};

                    if (is_string($value) && $value !== '') {
                        // explode, trim each email, filter out blanks, rejoin with plain commas
                        $clean = collect(explode(',', $value))
                            ->map(fn($e) => trim($e))
                            ->filter()
                            ->implode(',');

                        if ($clean !== $value) {
                            $house->{$col} = $clean;
                            $dirty = true;
                        }
                    }
                }

                if ($dirty) {
                    $house->saveQuietly();
                    $this->command->info("Normalized HouseID {$house->HouseID}");
                }
            }
        }, 'HouseID');

        $this->command->info('All houses normalized.');
    }
}
