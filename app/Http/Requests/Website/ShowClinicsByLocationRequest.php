<?php

namespace App\Http\Requests\Website;

use App\Models\City;
use App\Models\Region;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowClinicsByLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $cities = City::select()->where( 'status', 1)->get();
        $i = 0;
        $available_cities_id = [];
        foreach ($cities as $city) {
            $available_cities_id[$i] = $city->id;
            $i++;
        }
        $regions = Region::select()->where( 'status', 1)->get();
        $l = 0;
        $available_regions_id = [];
        foreach ($regions as $region) {
            $available_regions_id[$l] = $region->id;
            $l++;
        }
        return [
            'city_id'=>['nullable','exists:cities,id',Rule::in($available_cities_id),'integer'],
            'region_id'=>['nullable','exists:regions,id',Rule::in($available_regions_id),'integer'],
        ];
    }
}
