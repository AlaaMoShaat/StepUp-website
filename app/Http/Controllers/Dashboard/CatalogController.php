<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CatalogRequest;
use App\Services\Dashboard\CatalogService;

class CatalogController extends Controller
{

    protected $catalogService;
    public function __construct(CatalogService $catalogService) {
        $this->catalogService = $catalogService;
    }

    public function index()
    {
        return view('dashboard.catalogs.index');
    }

    public function getCatalog($id) {
        $catalog = $this->catalogService->getCatalog($id);
        return $catalog;
    }

    public function create($store_id)
    {
        return view('dashboard.catalogs.create', compact(['store_id']));
    }

    public function store(CatalogRequest $request) {
        $data = $request->only(['title', 'description', 'start_date', 'end_date', 'status', 'store_id']);
        $catalog = $this->catalogService->createCatalog($data);
          if (!$catalog) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function edit($id)
    {
        $catalog = self::getCatalog($id);
        return view('dashboard.catalogs.edit', compact(['catalog']));
    }

    public function update(CatalogRequest $request, $id) {
         $data = $request->only(['title', 'description', 'start_date', 'end_date', 'status', 'store_id']);
        $catalog = $this->catalogService->updateCatalog($data, $id);
          if (!$catalog) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }


    public function getAllCatalogs() {
        $catalogs = $this->catalogService->getCatalogsForDataTable();
        return $catalogs;
    }

      public function getStoreCatalogs($store_id) {
        $storeCatalogs = $this->catalogService->getStoreCatalogsForDataTable($store_id);
        return $storeCatalogs;
    }

      public function changeStatus($id) {
        $catalog = $this->catalogService->changeStatus($id);
        if (!$catalog) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $catalog = $this->getCatalog($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $catalog], 200);
    }

    public function destroy(string $id)
    {
        $catalog = $this->catalogService->deleteCatalog($id);
        if (!$catalog) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }
}