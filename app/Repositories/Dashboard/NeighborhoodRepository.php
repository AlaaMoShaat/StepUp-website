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
        $neighborhoods = Neighborhood::all()->map(function ($neighborhood) {
            return [
                'id' => $neighborhood->id,
                'postal_code' => $neighborhood->postal_code,
                'name' => $neighborhood->getTranslations('name'),
                'current_name' => $neighborhood->name
            ];
        });
        return $neighborhoods;
    }

    public function getNeighborhood($id)
    {
        return Neighborhood::with(['branches'])->find($id);
    }
}
