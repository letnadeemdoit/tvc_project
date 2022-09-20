<?php

namespace App\Actions\Fortify;

use App\Models\House;
use App\Models\User;
use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
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
            'country_id' => ['required'],
            'state_id' => ['nullable'],
            'city_id' => ['nullable'],
            'zipcode' => ['required'],
            'image' => 'nullable|image|mimes:png,jpg,gif,tiff|max:1024',
            'user_name' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'AdminOwner' => ['nullable'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required', (new \Laravel\Fortify\Rules\Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(),'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $country_name = Country::where('id',$input['country_id'])->first();
        $state_name = State::where('id',$input['state_id'])->first();
        $city_name = City::where('id',$input['city_id'])->first();


        $house = House::create([
            'HouseName' => $input['HouseName'],
            'primary_house_name' => $input['HouseName'],
            'country' => $country_name['name'] ?? null,
            'State' => $state_name['name'] ?? null,
            'City' => $city_name['name'] ?? null,
            'ZipCode' => $input['zipcode'],
            'ReferredBy' => $input['Referral_paypal_account'] ?? null,
        ]);

        $getCreatedHouseId = House::orderBy('HouseID', 'desc')->first();

        if ($house) {

            if (isset($input['image'])){
                $house->updateFile($input['image']);
            }

            if (!isset($input['AdminOwner'])) {

                $AdminOwner = 0;

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
                'primary_account' => 1,
                'old_password' => Hash::make('password'),
                'password' => Hash::make($input['password']),
            ]);

//            dd($user);

        }

        return $user;

    }
}
