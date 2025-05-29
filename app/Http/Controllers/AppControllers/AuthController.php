<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\AppControllers\BaseController as BaseController;
use App\Models\House;
use App\Models\Subscription;
use App\Models\User;
use App\Models\World\Country;
use App\Models\World\State;
use App\Notifications\NewUserAccountNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class AuthController extends BaseController
{
    public $newUser;
    public $siteUrl;

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
                'houseId' => 'required',
            ]);

            // Determine if the input is an email or a username
            $credentials = ['password' => $request->password, 'HouseID' => $request->houseId, 'is_confirmed' => 1];

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $request->email;
            } else {
                $credentials['user_name'] = $request->email;
            }

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $user->load('house');
                $subscription = Subscription::where([
                    'user_id' => primary_user()->user_id,
                    'house_id' => primary_user()->HouseId,
                ])->whereIn('plan', ['basic', 'standard', 'premium'])->first();

                $userArray = $user->toArray();
                unset($userArray['primary_user']);

                $success = [
                    'token' => $user->createToken('MyApp')->plainTextToken,
                    'user' => $userArray,
                    'subscription' => $subscription,
                    'primaryUser' => [
                        'user_id' => primary_user()->user_id,
                        'house_id' => primary_user()->HouseId,
                        'full_name' => primary_user()->first_name . ' ' . primary_user()->last_name,
                        'email' => primary_user()->email
                    ],
                ];
                return $this->sendResponse($success, 'User logged in successfully.');
            } else {
                return $this->sendError('Unauthorised. Email and password does not match.', []);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

//    public function login(Request $request)
//    {
//        try {
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required',
//            'houseId' => 'required',
//        ]);
//
//        if (Auth::attempt(['email' => $request->email, 'password' => $request->password , 'HouseID' => $request->houseId])) {
//            $user = Auth::user();
//
//            $user->load('house');
//            $subscription = Subscription::where([
//                'user_id' => primary_user()->user_id,
//                'house_id' => primary_user()->HouseId,
//                'status' => 'ACTIVE',
//            ])->whereIn('plan', ['basic', 'standard', 'premium'])->first();
//
//            $success['token'] = $user->createToken('MyApp')->plainTextToken;
//            $success['user'] = $user;
//            $success['subscription'] = $subscription;
//            return $this->sendResponse($success, 'User logged in successfully.');
//        } else {
//            return $this->sendError('Unauthorised. Email and password does not match.', []);
//        }
//        } catch (\Exception $e) {
//            return response()->json([
//                'error' => true,
//                'message' => $e->getMessage(),
//            ], 500);
//        }
//    }


    /**
     * Guest Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function guestLogin(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required',
                'houseId' => 'required',
            ]);

            if (Auth::attempt(['role' => 'Guest', 'password' => $request->password , 'HouseID' => $request->houseId])) {
                $user = Auth::user();

                $user->load('house');
                $subscription = Subscription::where([
                    'user_id' => primary_user()->user_id,
                    'house_id' => primary_user()->HouseId,
                ])->whereIn('plan', ['basic', 'standard', 'premium'])->first();

                $userArray = $user->toArray();
                unset($userArray['primary_user']);

                $success = [
                    'token' => $user->createToken('MyApp')->plainTextToken,
                    'user' => $userArray,
                    'subscription' => $subscription,
                    'primaryUser' => [
                        'user_id' => primary_user()->user_id,
                        'full_name' => primary_user()->first_name . ' ' . primary_user()->last_name,
                        'email' => primary_user()->email
                    ],
                ];
                return $this->sendResponse($success, 'User logged in successfully.');
            } else {
                return $this->sendError('Unauthorised. Credentials does not match.', []);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * House List api
     *
     * @return \Illuminate\Http\Response
     */
    public function houseList(Request $request)
    {

        try {
            $houseList = House::selectRaw('HouseID as id, HouseName, Status,
            TRIM(CONCAT(
                HouseName,
                IF(
                    Country IS NOT NULL AND Country <> "" OR
                    State IS NOT NULL AND State <> "" OR
                    City IS NOT NULL AND City <> "" OR
                    ZipCode IS NOT NULL AND ZipCode <> "",
                    " - ",
                    ""
                ),
                IF(Country IS NOT NULL AND Country <> "", CONCAT(Country, " "), ""),
                IF(State IS NOT NULL AND State <> "", CONCAT(State, " "), ""),
                IF(City IS NOT NULL AND City <> "", CONCAT(City, " "), ""),
                IF(ZipCode IS NOT NULL AND ZipCode <> "", CONCAT(ZipCode, ""), "")
            )) as text')
                ->where(function ($query) use ($request) {
                    $searchTerm = $request->q;
                    $query->where('HouseName', 'LIKE', "%$searchTerm%")
                        ->orWhere('City', 'LIKE', "%$searchTerm%")
                        ->orWhere('State', 'LIKE', "%$searchTerm%")
                        ->orWhere('Country', 'LIKE', "%$searchTerm%");
                })
                ->whereIn('Status', ['A', 'P', 'C'])
                ->limit(15)
                ->get();

            return response()->json([
                'success' => true,
                'results' => $houseList,
                'message' => 'Data fetched successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Countries List api
     *
     * @return \Illuminate\Http\Response
     */
    public function countriesList(Request $request)
    {

        try {
            $countries = Country::orderBy('name', 'ASC')->get();

            return response()->json([
                'success' => true,
                'results' => $countries,
                'message' => 'Data fetched successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * States List api
     *
     * @return \Illuminate\Http\Response
     */
    public function statesList(Request $request)
    {

        try {
            $states = [];
            if ($request->country_id){
                $states = State::where('country_id', $request->country_id)->orderBy('name', 'ASC')->get();
            }

            return response()->json([
                'success' => true,
                'results' => $states,
                'message' => 'Data fetched successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $input = $request->all();

//            $success['user'] = $input;
//            return $this->sendResponse($success, 'Data from front end.');
//            exit();

            // Validate incoming request
            $validator = Validator::make($input, [
                'HouseName' => ['required', 'unique:House'],
                'country_id' => ['required'],
                'state_id' => ['nullable'],
                'city_id' => ['nullable'],
                'zipcode' => ['required'],
                'image' => 'nullable|image|mimes:png,jpg,gif,tiff|max:20480',
                'user_name' => ['required', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role' => ['required'],
                'AdminOwner' => ['nullable'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'password' => ['required', (new \Laravel\Fortify\Rules\Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(), 'confirmed'],
                'password_confirmation' => 'required|same:password',
                'old_password' => 'required|same:password',
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }


            $country_name = Country::find($input['country_id']);
            $state_name = State::find($input['state_id']);

            // Create House
            $house = House::create([
                'HouseName' => $input['HouseName'],
                'primary_house_name' => $input['HouseName'],
                'country' => $country_name->name ?? null,
                'State' => $state_name->name ?? null,
                'Status' => 'P',
                'City' => $input['city_id'] ?? null,
                'ZipCode' => $input['zipcode'],
                'ReferredBy' => $input['Referral_paypal_account'] ?? null,
            ]);

            $getCreatedHouseId = House::orderBy('HouseID', 'desc')->first();

            // Create User
            if ($house) {

                if (isset($input['image'])) {
                    $house->updateFile($input['image']);
                }

                if (!isset($input['AdminOwner'])) {

                    $AdminOwner = 0;

                } else {

                    $AdminOwner = $input['AdminOwner'];

                }

                $this->newUser = User::create([
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


            }

            $this->newUser->load('house');
            $success['token'] =  $this->newUser->createToken('MyApp')->plainTextToken;
            $success['user'] = $this->newUser;
            $success['primaryUser'] = [
                'user_id' => $this->newUser->user_id,
                'house_id' => $this->newUser->HouseId,
                'full_name' => $this->newUser->first_name . ' ' . $this->newUser->last_name,
                'email' => $this->newUser->email
            ];
            $success['subscription'] = null;

            $this->siteUrl = route('login', ['houseId' => $getCreatedHouseId->HouseID]);

            try {
                $firstName = $input['first_name'];
                $lastName = $input['last_name'];
                $userName = $input['user_name'];
                $email = $input['email'];
                $houseName = $input['HouseName'];
                if($this->newUser){
                    Notification::route('mail', $input['email'])
                    ->notify(new NewUserAccountNotification($firstName,$lastName, $userName,$email,$houseName,$this->siteUrl));
                }

            } catch (\Exception $e) {
                return $this->sendError($e->getMessage(), []);
            }

            return $this->sendResponse($success, 'User registered successfully.');

        }
        catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }

    public function getAuthUser(Request $request)
    {

        try {
            $user = Auth::user();
            $user->load('house');
            $subscription = Subscription::where([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'status' => 'ACTIVE',
            ])->whereIn('plan', ['basic', 'standard', 'premium'])->first();

            $success['user'] = $user;
            $success['subscription'] = $subscription;

            return $this->sendResponse($success, 'User fetch successfully.');

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteUserAccount(Request $request)
    {
        try {
            $user = Auth::user();
            $isConfirmedValue = 0;
            $usersOwner = User::where('parent_id', $user->parent_id)->where('email', $user->email)->whereIn('role', ['Administrator','Owner'])->get();
            if (count($usersOwner) > 0){
                foreach ($usersOwner as $owner){
                    $owner->update(['is_confirmed' => $isConfirmedValue]);
                }
            }
            else{
                $guestUser = User::where('parent_id', $user->parent_id)->where('HouseId', $user->HouseId)->where('role', 'Guest')->first();
                $guestUser->update(['is_confirmed' => $isConfirmedValue]);
            }
            $user->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'User account deleted successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }



}
