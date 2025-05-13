<?php

namespace App\Repositories\Dashboard;

use App\Models\Neighborhood;

class NeighborhoodRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getNeighborhoods()
    {
        $neighborhoods = Neighborhood::with('branches')->when(!empty(request()->keyword), function($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->get();
        return $neighborhoods;
    }

    public function getNeighborhood($id)
    {
        return Neighborhood::with(['branches'])->find($id);
    }
}
