<?php

namespace App\Http\Controllers\AppControllers;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Rules\Password;

class UserProfileController extends BaseController
{

    public $siteUrl;



    /**
     * Auth User api
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        try {

            $user = Auth::user();
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User get successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error:', ['message' => $e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Profile Picture api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePicture(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:20480'],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $photo = $request->file('photo');

            if (!$photo->isValid()) {
                return $this->sendError('Invalid file upload', [], 422);
            }

            $user->updateProfilePhoto($photo);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Profile picture updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error updating profile picture', ['message' => $e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Basic Information api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBasicInfo(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $user->fill([
                'first_name' => $inputs['first_name'] ?? '',
                'last_name' => $inputs['last_name'] ?? ''
            ])->save();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Basic Information updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error:', ['message' => $e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Update Email api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateEmailAddress(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'email' => ['required'],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $user->fill([
                'email' => $inputs['email'] ?? '',
            ])->save();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User Email updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error:', ['message' => $e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }

    /**
     * Update Admin Password api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAdminPassword(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'current_password' => ['required', function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    if (!\Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'new_password' => [
                    'required',
                    'string',
                    (new Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(),
                    'confirmed'
                ]
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($user->role === 'Owner') {
                $houseIds = User::where('email', $user->email)->where('role', 'Owner')->get()->pluck('HouseId');
                User::whereIn('HouseId', $houseIds)->where('email', $user->email)->update([
                    'password' => \Hash::make($inputs['new_password']),
                ]);
            } else {
                $user->fill([
                    'password' => \Hash::make($inputs['new_password']),
                ])->save();
            }

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Admin updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error:', ['message' => $e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Update Guest Password api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateGuestPassword(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();

            $guestUser = User::where([
                'HouseId' => $user->HouseId,
                'role' => 'Guest',
            ])->first();

            $validator = Validator::make($inputs, [
                'new_password' => [
                    'required',
                    'string',
                    (new Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(),
                    'confirmed'
                ]
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($guestUser) {
                $guestUser->update([
                    'password' => \Hash::make($inputs['new_password']),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Guest password updated successfully',
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'No guest user exists for this house property',
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error:', ['message' => $e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Update Preferences api
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePreferences(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();

            // Validate inputs (allow 0 and 1 as valid)
            $validator = Validator::make($inputs, [
                'show_additional_schedule_vacations_screen' => ['nullable', 'in:0,1'],
                'allow_administrator_to_have_owner_permissions' => ['nullable', 'in:0,1'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'data' => $validator->errors(),
                ], 422);
            }

            if ($user->primary_account == 1) {
                $otherUsers = User::where('parent_id', $user->user_id)
                    ->where('role', 'Administrator')
                    ->get();

                foreach ($otherUsers as $otherUser) {
                    $otherUser->fill([
                        'ShowOldSave' => $inputs['show_additional_schedule_vacations_screen'],
                        'AdminOwner' => $inputs['allow_administrator_to_have_owner_permissions'],
                    ])->save();
                }
            }

            $user->fill([
                'ShowOldSave' => $inputs['show_additional_schedule_vacations_screen'],
                'AdminOwner' => $inputs['allow_administrator_to_have_owner_permissions'],
            ])->save();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User preferences updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Logout Other Browsers API
     *
     * @param \Illuminate\Contracts\Auth\StatefulGuard $guard
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutOtherBrowsers(StatefulGuard $guard)
    {
        try {
            $user = Auth::user();

            // Check if the session driver is database
            if (config('session.driver') !== 'database') {
                return response()->json([
                    'success' => false,
                    'message' => 'Session driver is not set to database.',
                ], 400);
            }

            // Get the password from the request
            $password = request()->input('password');

            if (! Hash::check($password, $user->password)) {
                throw ValidationException::withMessages([
                    'password' => [__('This password does not match our records.')],
                ]);
            }

            // Logout other devices
            $guard->logoutOtherDevices($password);

            // Delete other session records
            $this->deleteOtherSessionRecords();

            // Update the session with the new password hash
            request()->session()->put([
                'password_hash_'.Auth::getDefaultDriver() => $user->getAuthPassword(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Logged out from other browsers successfully.',
            ], 200);

        } catch (ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Error logging out from other browsers:', ['message' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while logging out from other browsers.',
            ], 500);
        }
    }

    /**
     * Delete Other Session Records
     */
    protected function deleteOtherSessionRecords()
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::id())
            ->where('id', '!=', request()->session()->getId())
            ->delete();
    }



}
