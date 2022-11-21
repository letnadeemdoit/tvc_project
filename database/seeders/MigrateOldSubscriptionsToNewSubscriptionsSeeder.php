<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\Paypal\SubscriptionInfo;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Facades\PayPal;

class MigrateOldSubscriptionsToNewSubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paypal = PayPal::setProvider();
        $paypal->getAccessToken();
        $progressBar = $this->command->getOutput()->createProgressBar(House::where('Status', 'A')->count());
        House::where('Status', 'A')
            ->chunk(100, function ($houses) use ($paypal, $progressBar) {
                foreach ($houses as $house) {
                    $progressBar->advance();
                    $oldSubscription = DB::table('paypal_subscription_info')
                        ->where('custom', $house->HouseID)
                        ->where('subscr_id', 'LIKE', 'I-%')
                        ->latest('custom')
                        ->first();

                    if ($oldSubscription) {
                        $paypalSubscription = $paypal->showSubscriptionDetails($oldSubscription->subscr_id);
                        if (isset($paypalSubscription['status'])) {
                            $housePrimaryUser = User::where([
                                'role' => User::ROLE_ADMINISTRATOR,
                                'HouseId' => $house->HouseID,
                                'primary_account' => 1,
                            ])->first();

                            if ($housePrimaryUser) {
                                $mode = config('paypal.mode');

                                Subscription::firstOrCreate([
                                    'user_id' => $housePrimaryUser->user_id,
                                    'subscription_id' => $oldSubscription->subscr_id,
                                ], [
                                    'user_id' => $housePrimaryUser->user_id,
                                    'house_id' => $housePrimaryUser->HouseId,
                                    'subscription_id' => $oldSubscription->subscr_id,
                                    'plan_id' => config("paypal.$mode.plans.basic.yearly"),
                                    'plan' => 'basic',
                                    'period' => 'yearly',
                                    'is_migrated' => 1,
                                    'status' => $paypalSubscription['status'],
                                ]);
                            }
                        }
                    }
                }
            });

        $progressBar->finish();

        $lyonUser = User::where([
            'email' => 'lyont1@yahoo.com',
            'primary_account' => 1,
            'HouseId' => 1
        ])->first();

        if ($lyonUser) {
            $mode = config('paypal.mode');

            Subscription::firstOrCreate([
                'user_id' => $lyonUser->user_id,
                'subscription_id' => '-',
            ], [
                'user_id' => $lyonUser->user_id,
                'house_id' => $lyonUser->HouseId,
                'subscription_id' => '',
                'plan_id' => config("paypal.$mode.plans.basic.yearly"),
                'plan' => 'basic',
                'period' => 'yearly',
                'status' => 'Active',
                'is_migrated' => 1,
            ]);
        }
    }
}
