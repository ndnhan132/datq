<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function GetAllProvinces(Request $request) {

        $provinces = Province::select("id","name")->get();

        if ( $provinces->count() > 0 ) {
            return response()->json($provinces);
        }

        if ( $this->CopyAllProvinces() ){
            $provinces = Province::all();
            return response()->json($provinces);
        };

        return response()->json(['message' => 'Wait...'], 403);
    }
    public function GetDistrictsByProvinceId(Request $request , $provinceId) {
        $districts = District::select("id","name", "province_id")
                                ->where("province_id",  $provinceId )
                                ->get();
        if ( $districts->count() > 0 ) {
            return response()->json($districts);
        }           
        if ( $this->CopyDistrictsByProvinceId($provinceId) ){
            $districts = District::select("id","name", "province_id")
                                ->where("province_id",  $provinceId )
                                ->get();
            return response()->json($districts);
        };

        return response()->json(['message' => 'Wait...'], 403);
    }
    public function GetWardsByDistrictId(Request $request , $districtId) {
        $wards = Ward::select("id","name", "district_id")
                ->where("district_id",  $districtId )
                ->get();
        if ( $wards->count() > 0 ) {
        return response()->json($wards);
        }           
        if ( $this->CopyWardsByDistrictId($districtId) ){
            $wards = Ward::select("id","name", "district_id")
            ->where("district_id",  $districtId )
            ->get();
        return response()->json($wards);
        };

        return response()->json(['message' => 'Wait...'], 403);
    }


    public function CopyAllProvinces() {
        try {
                $api = 'https://www.avakids.com/cart/api/location/GetAllProvinces';
                $res = curlApiGet($api);
                $data = $res->data;
                foreach ( $data as $province) {
                    Province::create([
                        'name'              => $province->provinceName,
                        'avk_provinceID'    => $province->provinceID,
                    ]);
                }

                // Log::alert("CopyAllProvinces : " . $api );
            return true;
        } catch (Exception $e) {
            Log::alert("Lỗi: " . $e->getMessage() );
            return false;
        }
    }
    public function CopyDistrictsByProvinceId($provinceId) {
        try {
            $province = Province::findOrFail($provinceId);
            $api = 'https://www.avakids.com/cart/api/location/GetDistrictsByProvinceId/' . $province->avk_provinceID;
            $res = curlApiGet($api);
            $data = $res->data;
            foreach ( $data as $district) {
                District::create([
                    'name'              => $district->districtName,
                    "province_id"       => $provinceId,
                    'avk_districtID'    => $district->districtID,
                ]);
            }

            // Log::alert("CopyDistrictsByProvinceId : " . $api );
            return true;
        } catch (Exception $e) {
            Log::alert("Lỗi: " . $e->getMessage() );
            return false;
        }
    }
    public function CopyWardsByDistrictId($districtId) {
        try {
            $district = District::findOrFail($districtId);
            $api = 'https://www.avakids.com/cart/api/location/GetWardsByDistrictId/' . $district->avk_districtID;
            $res = curlApiGet($api);
            $data = $res->data;
            foreach ( $data as $ward) {
                Ward::create([
                    'name'              => $ward->wardName,
                    "district_id"       => $districtId,
                    'avk_wardID'        => $ward->wardID,
                ]);
            }

            // Log::alert("CopyWardsByDistrictId : " . $api );
            return true;
        } catch (Exception $e) {
            Log::alert("Lỗi: " . $e->getMessage() );
            return false;
        }
    }

    public static function searchLocation(Request $request) 
    {
        $search = $request->input('search');
        $data = [];
        $provinces = Province::where('name', 'LIKE', '%'.$search.'%')->get();
        if ( $provinces ) {
            foreach ($provinces as $province) {
                $item = new \stdClass();
                $item->fullSuggest = $province->name;
                $item->province = $province->only(['id', 'name']);
                $data[] = $item;
            }
        }
        $districts = District::where('name', 'LIKE', '%'.$search.'%')->get();

         if ( $districts ) {
            foreach ($districts as $district) {
                $item = new \stdClass();
                $item->fullSuggest =  $district->name. ", ". $district->province->name;
                $item->province = $district->province->only(['id', 'name']);
                $item->district = $district->only(['id', 'name']);
                $data[] = $item;
            }
        }

        $wards = Ward::where('name', 'LIKE', '%'.$search.'%')->get();
        if ( $wards ) {
            foreach ($wards as $ward) {
                $item = new \stdClass();
                $item->fullSuggest =  $ward->name. ", ". $ward->district->name. ", ". $ward->district->province->name;
                $item->province = $ward->district->province->only(['id', 'name']);
                $item->district = $ward->district->only(['id', 'name']);
                $item->ward = $ward->only(['id', 'name']);
                $data[] = $item;
            }
        }

        return response()->json($data);
    }


}
