<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\NeighborhoodRepository;

class NeighborhoodService
{
    protected $neighborhoodRepository;
    public function __construct(NeighborhoodRepository $neighborhoodRepository)
    {
        $this->neighborhoodRepository = $neighborhoodRepository;
    }
    public function getNeighborhoods()
    {
        $neighborhoods = $this->neighborhoodRepository->getNeighborhoods();
        if (!$neighborhoods) {
            return abort(404);
        }
        return $neighborhoods;
    }

    public function getNeighborhood($id) {
        $neighborhood = $this->neighborhoodRepository->getNeighborhood($id);
        if (!$neighborhood) {
            abort(404);
        }
        return $neighborhood;
    }
}