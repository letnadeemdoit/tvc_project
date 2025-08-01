<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
use App\Rules\PortraitImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HouseSettingsController extends BaseController
{

    public $file;
    public $login_file;


    /**
     * Get House Details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getHouseDetails(Request $request)
    {
        try {
            $user = Auth::user();
            $house = $user->house;

            $response = [
                'success' => true,
                'data' => [
                    'house' => $house,
                ],
                'message' => 'Data fetched successfully',
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }
    /**
     * Update House Settings api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateHouseSettings(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();

//            $house = House::where('HouseID', $inputs['HouseID'])->first();
            $house = House::find($inputs['HouseID']);

            $this->file = $request->file('file');
            $this->login_file = $request->file('login_file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                $house->deleteFile('image');
                unset($inputs['image']);
            }
            if ($this->login_file) {
                $inputs['login_image'] = $this->login_file;
            } else {
                $house->deleteFile('login_image');
                unset($inputs['login_image']);
            }

            $validator = Validator::make($inputs, [
                'image' => 'nullable|mimes:png,jpg,gif,tiff',
                'login_image' => ['nullable', 'mimes:png,jpg,gif,tiff', new PortraitImage],
                'primary_house_name' => ['nullable', 'string', 'max:100'],

                'HouseName' => [
                    'required',
                    'string',
                    'max:40',
                    'unique:House,HouseName,' . $house->HouseID . ',HouseID'
                ],
                'country_id' => ['nullable'],
                'city_id' => ['nullable'],
                'state_id' => ['nullable'],
                'zipcode' => ['nullable', 'string', 'max:10'],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $country_name = Country::where('id',$inputs['country_id'])->first();
            $state_name = State::where('id',$inputs['state_id'])->first();
            $city_name = City::where('id',$inputs['city_id'])->first();

            $house->fill([
                'HouseName' => $inputs['HouseName'],
                'is_default_image' => $inputs['is_default_image'] ?? 0,
                'is_default_login_image' => $inputs['is_default_login_image'] ?? 0,
                'primary_house_name' => $inputs['primary_house_name'],
                'country' => $country_name['name'] ?? null,
                'State' => $state_name['name'] ?? null,
                'City' => $city_name['name'] ?? null,
                'ZipCode' => $inputs['zipcode'] ?? null,
            ])->save();

            $house->updateFile($this->file, 'image');
            $house->updateFile($this->login_file,'login_image');


            return response()->json([
                'success' => true,
                'house' => $house,
                'message' => 'House updated successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
        if ($this->login_file){
            $this->validateOnly('login_file', ['login_file', 'required|mimes:png,jpg,gif,tiff', new PortraitImage]);
        }
    }


}
