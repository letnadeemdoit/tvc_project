<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\PasswordResetEmailNotification;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Fortify\Fortify;

class PasswordResetLinkController extends Controller
{
    /**
     * Show the reset password link request view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse
     */
    public function create(Request $request): RequestPasswordResetLinkViewResponse
    {
        return app(RequestPasswordResetLinkViewResponse::class);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
//    public function store(Request $request): Responsable
//    {
//        $request->validate([
//            Fortify::email() => 'required|email'
//
//        ]);
//
//
//        // We will send the password reset link to this user. Once we have attempted
//        // to send the link, we will examine the response then see the message we
//        // need to show to the user. Finally, we'll send out a proper response.
//        $status = $this->broker()->sendResetLink(
//            $request->only([Fortify::email(), 'HouseId'])
//        );
//
//        return $status == Password::RESET_LINK_SENT
//                    ? app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $status])
//                    : app(FailedPasswordResetLinkRequestResponse::class, ['status' => $status]);
//    }


    public function store(Request $request): Responsable
    {
        $request->validate([
            Fortify::email() => 'required|email'
        ]);

        $user = User::where('email', $request->email)->where('HouseId', $request->HouseId)->first();

        if (!$user) {
            return app(FailedPasswordResetLinkRequestResponse::class, [
                'status' => Password::INVALID_USER,
            ]);
        }

        // Create password reset token
        $token = $this->broker()->createToken($user);

        $url = URL::route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]);
        // Send custom notification
        $user->notify(new PasswordResetEmailNotification($url));

        return app(SuccessfulPasswordResetLinkRequestResponse::class, [
            'status' => Password::RESET_LINK_SENT
        ]);
    }


    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker(config('fortify.passwords'));
    }
}
