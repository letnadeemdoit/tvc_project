<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Fortify::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('HouseId', $request->house_id)
                ->where('is_confirmed', 1)
                ->when($request->role !== 'Guest', function ($query) use ($request) {
                    $query->where(function ($query) use ($request)  {
                        $query->where('email', $request->email)->orWhere('user_name', $request->email);
                    });
                })
                ->when($request->role === 'Guest', function ($query) use ($request) {
                    $query->where('role', 'Guest');
                })
                ->first();

            if ($user) {
                // Check old password hash md5
                if (md5($request->password) === $user->password) {
                    $user->old_password = $user->password;
                    // if signing in using old password hash update their hash
                    $user->password = Hash::make($request->password);
                    $user->save();

                    return $user;
                } elseif (Hash::check($request->password, $user->password)) {
                    return $user;
                }
            }
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string)$request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
