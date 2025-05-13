<?php

namespace App\Services\Dashboard;

use Exception;
use App\Utils\ImageManeger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\StoreRepository;
use App\Repositories\Dashboard\StoreBranchRepository;

class StoreService
{
    protected $storeRepository, $imageManeger, $storeBranchRepository;
    public function __construct(StoreRepository $storeRepository, StoreBranchRepository $storeBranchRepository, ImageManeger $imageManeger)
    {
        $this->imageManeger = $imageManeger;
        $this->storeRepository = $storeRepository;
        $this->storeBranchRepository = $storeBranchRepository;
    }

    public function getStores() {
        return $this->storeRepository->getStores();
    }

    public function getStoresForDataTable() {
        $stores = $this->storeRepository->getStores();
        return DataTables::of($stores)->addIndexColumn()
        ->addColumn('status', function($store) {
            return '<p id="status_' . $store->id . '"
                style="align-items: center; border-radius: 6px; text-align: center;"
                class="' . ($store->status == 1 ? 'btn-success' : 'btn-danger') . '">
                ' . $store->getStatusTranslatable() . '
             </p>';

        })->addColumn('name', function($store) {
            return $store->getTranslation('name', app()->getLocale());
        })->addColumn('importance_level', function($store) {
                if($store->importance_level == 'featured') {
                    return __('static.stores.featured');
                }elseif($store->importance_level == 'normal') {
                    return __('static.stores.normal');
                }elseif($store->importance_level == 'low') {
                    return __('static.stores.low');
                }
        })->addColumn('logo', function($store) {
            return '<img src="'.asset($store->logo).'" width="50px" height="50px"/>';
        })->addColumn('catalogs_count', function($store) {
            return $store->catalogs_count == 0 ? __('static.global.no_items') : $store->catalogs_count;
        })->addColumn('actions', function ($store) {
            return view('dashboard.stores.datatables.actions', compact('store'));
        })->rawColumns(['actions', 'logo', 'status'])->make(true);
    }

    public function getStore($id) {
        $store = $this->storeRepository->getStore($id);
        if (!$store) {
            abort(404);
        }
        return $store;
    }

    public function createStore($data) {
        try {
            DB::beginTransaction();
            if(!empty($data['logo'])) {
                $file_name = $this->imageManeger->uploadSingleImage('/', $data['logo'], 'stores');
                $data['logo'] = $file_name; //update logo value
            }
            $store = $this->storeRepository->createStore($data);
            foreach ($data['branches'] as $branch) {
                $this->storeBranchRepository->storeBranch($store, $branch);
            }
            DB::commit();
            return $store;
        }catch(Exception $e) {
            DB::rollBack();
            throw $e;
            Log::error("error attributes product", $e->getMessage());
            return false;
        }
        if (!$store) {
            return false;
        }
        self::storeCache();
        return $store;
    }

  public function updateStore($id, $data) {
        try {
            DB::beginTransaction();
            $store = $this->getStore($id);

            if(!empty($data['logo'])) {
                if($store->logo != null) {
                    $this->imageManeger->deleteImageFromLocal($store->logo);
                }
                $file_name = $this->imageManeger->uploadSingleImage('/', $data['logo'], 'stores');
                $data['logo'] = $file_name; //update logo value
            }

            $this->storeRepository->updateStore($store, $data);

            $this->storeBranchRepository->deleteStoreBranches($store);

            foreach ($data['branches'] as $branch) {
                $this->storeBranchRepository->storeBranch($store, $branch);
            }

            DB::commit();
            return $store;

        }catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            Log::error("error updating attribute", $e->getMessage());
            return false;
        }
    }


    public function deleteStore($id) {
        $store = $this->getStore($id);
        if($store->logo != null) {
            $this->imageManeger->deleteImageFromLocal($store->logo);
        }
        $store = $this->storeRepository->deleteStore($store);
        self::storeCache();
        return $store;
    }

    public function changeStatus($id) {
        $store = $this->getStore($id);
        if (!$store) {
            abort(404);
        }
        $store = $this->storeRepository->changeStatus($store);
        if (!$store) {
            return false;
        }
        self::storeCache();
        return $store;
    }


    public function storeCache() {
        Cache::forget('stores_count');
    }
}
