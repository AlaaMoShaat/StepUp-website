<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\CatalogRepository;

class CatalogService
{
    protected $catalogRepository;
    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function createCatalog($data)
    {
        $catalog = $this->catalogRepository->createCatalog($data);
        if(!$catalog) {
            return false;
        }
        return $catalog;
    }

    public function updateCatalog($data, $id) {
        $catalog = self::getcatalog($id);
        $catalog = $this->catalogRepository->updateCatalog($data, $catalog);
        if (!$catalog) {
            return false;
        }
        return $catalog;
    }
    public function getcatalog($id) {
        $catalog = $this->catalogRepository->getCatalog($id);
        if (!$catalog) {
            abort(404);
        }
        return $catalog;
    }

    public function getCatalogsForDataTable() {
        $catalogs = $this->catalogRepository->getCatalogs();
        return DataTables::of($catalogs)->addIndexColumn()
        ->addColumn('status', function($catalog) {
            return '<p id="status_' . $catalog->id . '"
                style="align-items: center; border-radius: 6px; text-align: center;"
                class="' . ($catalog->status == 1 ? 'btn-success' : 'btn-danger') . '">
                ' . $catalog->getStatusTranslatable() . '
             </p>';

        })->addColumn('title', function($catalog) {
            return $catalog->getTranslation('title', app()->getLocale());
        })->addColumn('description', function($catalog) {
            return $catalog->getTranslation('description', app()->getLocale());
        })->addColumn('actions', function ($catalog) {
            return view('dashboard.catalogs.datatables.actions', compact('catalog'));
        })->rawColumns(['actions', 'status'])->make(true);
    }

    public function getStoreCatalogsForDataTable($store_id) {
        $catalogs = $this->catalogRepository->getStoreCatalogs($store_id);
        return DataTables::of($catalogs)->addIndexColumn()
        ->addColumn('status', function($catalog) {
            return '<p id="status_' . $catalog->id . '"
                style="align-items: center; border-radius: 6px; text-align: center;"
                class="' . ($catalog->status == 1 ? 'btn-success' : 'btn-danger') . '">
                ' . $catalog->getStatusTranslatable() . '
             </p>';

        })->addColumn('title', function($catalog) {
            return $catalog->getTranslation('title', app()->getLocale());
        })->addColumn('description', function($catalog) {
            return $catalog->getTranslation('description', app()->getLocale());
        })->addColumn('actions', function ($catalog) {
            return view('dashboard.catalogs.datatables.actions', compact('catalog'));
        })->rawColumns(['actions', 'status'])->make(true);
    }

// ->addColumn('brochurs_count', function($catalog) {
//             return $catalog->brochurs_count == 0 ? __('static.global.no_items') : $catalog->brochurs_count;
//         })


    public function changeStatus($id) {
        $catalog = $this->getCatalog($id);
        if (!$catalog) {
            abort(404);
        }
        $catalog = $this->catalogRepository->changeStatus($catalog);
        if (!$catalog) {
            return false;
        }
        self::catalogCache();
        return $catalog;
    }

    public function deleteCatalog($id) {
        $catalog = $this->getCatalog($id);
        $catalog = $this->catalogRepository->deletecatalog($catalog);
        self::catalogCache();
        return $catalog;
    }

      public function catalogCache() {
        Cache::forget('catalogs_count');
    }

}
