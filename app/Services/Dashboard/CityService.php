<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CityRepository;

class CityService
{
    protected $cityRepository;
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getCities()
    {
        $cities = $this->cityRepository->getCities();
        if (!$cities) {
            abort(404);
        }
        return $cities;
    }

    public function getCity($id)
    {
        $city = $this->cityRepository->getCity($id);
        if (!$city) {
            abort(404);
        }
        return $city;
    }
}