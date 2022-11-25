<?php

namespace App\Console\Commands;

use App\Notifications\SubscriptionCanceledEmailNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class SendEmailToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Send Successfully';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        if (!empty($users)) {
            foreach ($users as $key => $user) {
                try {

                    $details = [
                        'title' => 'Subscription Cancel Email!',
                        'text' => 'Your subscription for vacation calendar will be canceled from tomorrow And You can Again subscribe it with new Updates.'
                    ];

                    usleep(500000);

                    $user->notify(new SubscriptionCanceledEmailNotification($details));

                } catch (Exception $e) {
                    info("Error: ". $e->getMessage());
                }
            }
        }
        return 0;
    }
}
