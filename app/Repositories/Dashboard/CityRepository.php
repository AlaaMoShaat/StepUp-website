<?php

namespace App\Repositories\Dashboard;

use App\Models\City;

class CityRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getCities()
    {
        $cities = City::withCount(['neighborhoods'])->when(!empty(request()->keyword), function($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->paginate(6);
        return $cities;
    }

    public function getCity($id)
    {
        return City::with(['neighborhoods'])->find($id);
    }

}