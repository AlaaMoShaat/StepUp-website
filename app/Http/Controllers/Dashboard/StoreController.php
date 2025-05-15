<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\StoreService;
use App\Http\Requests\Dashboard\StoreRequest;
use App\Services\Dashboard\NeighborhoodService;
use App\Services\Dashboard\DayService;
use App\Services\Dashboard\StoreBranchService;

class StoreController extends Controller
{
    public function __construct(
        protected StoreService $storeService,
        protected StoreBranchService $storeBranchService,
        protected NeighborhoodService $neighborhoodService,
        protected DayService $dayService
    ) {}

    public function getAllStores()
    {
        $stores = $this->storeService->getStoresForDataTable();
        return $stores;
    }

    public function getAllNeighborhoods()
    {
        $neighborhoods = $this->neighborhoodService->getNeighborhoods();
        return $neighborhoods;
    }

    public function getAllDays()
    {
        $days = $this->dayService->getDays();
        return $days;
    }

    public function index()
    {
        $stores = $this->getAllStores();
        return view('dashboard.stores.index', compact(['stores']));
    }

    public function create()
    {
        $neighborhoods = $this->getAllNeighborhoods();
        $days = $this->getAllDays();
        return view('dashboard.stores.create', compact(['neighborhoods', 'days']));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->only(['name', 'status', 'logo', 'phone', 'importance_level','website_url', 'email', 'branches']);
        $store = $this->storeService->createStore($data);
        if (!$store) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.stores.index')->with('success', __('messages.success_msg'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $store = $this->storeService->getStore($id);
        $neighborhoods = $this->getAllNeighborhoods();
        $days = $this->getAllDays();
        return view('dashboard.stores.edit', compact(['store', 'neighborhoods', 'days']));
    }

    public function update(StoreRequest $request, string $id)
    {
        $data = $request->only(['name', 'status', 'logo', 'phone', 'importance_level','website_url', 'email', 'branches']);
        $store = $this->storeService->updateStore($id, $data);
         if (!$store) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.stores.index')->with('success', __('messages.success_msg'));
    }

    public function destroy(string $id)
    {
        $store = $this->storeService->deleteStore($id);
        if (!$store) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id)
    {
        $store = $this->storeService->changeStatus($id);
        if (!$store) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $store = $this->storeService->getStore($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $store], 200);
    }
}
