<?php

namespace App\Repositories\Dashboard;

use App\Models\Catalog;

class CatalogRepository
{
    public function getCatalogs()
    {
        $catalogs = Catalog::withCount('brochures')->latest()->get();
        return $catalogs;
    }

    public function getStoreCatalogs($store_id) {
        $catalogs = Catalog::where('store_id', $store_id)->withCount('brochures')->latest()->get();
        return $catalogs;
    }

    public function getCatalog($id)
    {
        return Catalog::find($id);
    }

     public function createCatalog($data)
    {
        return Catalog::create($data);
    }

    public function updateCatalog($data, $catalog) {
        $catalog->update($data);
        return $catalog;
    }

    public function changeStatus($catalog)
    {
        $catalog = $catalog->update([
            'status' => $catalog->status == '1' ? '0' : '1',
        ]);
        return $catalog;
    }

    public function deleteCatalog($catalog) {
        return $catalog->delete();
    }

}