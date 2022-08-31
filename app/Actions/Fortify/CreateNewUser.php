<?php

namespace App\Actions\Fortify;

use App\Models\House;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'HouseName' => ['required', 'unique:House'],
            'City' => ['required'],
            'State' => ['required'],
            'image' => 'image|mimes:png,jpg,gif,tiff|max:1024|nullable',
            'Referral_paypal_account' => ['required'],
            'user_name' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'AdminOwner' => ['nullable'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $house = House::create([
            'HouseName' => $input['HouseName'],
            'City' => $input['City'],
            'State' => $input['State'],
            'ReferredBy' => $input['Referral_paypal_account'],
        ]);

        $getCreatedHouseId = House::orderBy('HouseID', 'desc')->first();

        if ($house) {

            if (!isset($input['AdminOwner'])) {
                $AdminOwner = 'N';
            } else {
                $AdminOwner = $input['AdminOwner'];
            }

            $user = User::create([
                'user_name' => $input['user_name'],
                'email' => $input['email'],
                'AdminOwner' => $AdminOwner,
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'role' => $input['role'],
                'HouseId' => $getCreatedHouseId->HouseID,
                'is_confirmed' => 1,
                'old_password' => Hash::make('password'),
                'password' => Hash::make($input['password']),
            ]);
        }

        return $user;

    }
}
