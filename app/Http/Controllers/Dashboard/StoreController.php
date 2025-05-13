<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\StoreService;
use App\Http\Requests\Dashboard\StoreRequest;
use App\Services\Dashboard\NeighborhoodService;
use App\Services\Dashboard\StoreBranchService;

class StoreController extends Controller
{
    protected $storeService, $storeBranchService, $neighborhoodService;
    public function __construct(StoreService $storeService, StoreBranchService $storeBranchService, NeighborhoodService $neighborhoodService) {
        $this->storeService = $storeService;
        $this->storeBranchService = $storeBranchService;
        $this->neighborhoodService = $neighborhoodService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeService->getStoresForDataTable();
        $neighborhoods = $this->neighborhoodService->getNeighborhoods();
        return view('dashboard.stores.index', compact(['stores', 'neighborhoods']));
    }

    public function getAllStores() {
        $stores = $this->storeService->getStoresForDataTable();
        return $stores;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $store = $this->
        // return view('dashboard.stores.create');
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store = $this->storeService->getStore($id);
        $neighborhoods = $this->neighborhoodService->getNeighborhoods();
        return view('dashboard.stores.edit', compact(['store', 'neighborhoods']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $data = $request->only(['name', 'status', 'logo', 'phone', 'importance_level','website_url', 'email', 'branches']);
        $store = $this->storeService->updateStore($id, $data);
         if (!$store) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.stores.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = $this->storeService->deleteStore($id);
        if (!$store) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }


    public function changeStatus($id) {
        $store = $this->storeService->changeStatus($id);
        if (!$store) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $store = $this->storeService->getStore($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $store], 200);
    }
}