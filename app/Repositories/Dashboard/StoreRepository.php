<?php

namespace App\Repositories\Dashboard;

use App\Models\Appointment;
use App\Models\Store;

class StoreRepository
{
    public function getStore($id)
    {
        return Store::find($id);
    }

    public function getStores()
    {
        $stores = Store::withCount('catalogs')->latest()->get();
        return $stores;
    }

    public function createStore($data)
    {
        return Store::create([
            'name' => $data['name'],
            'logo' =>$data['logo'],
            'importance_level' => $data['importance_level'],
            'website_url' => $data['website_url'] ?? null,
            'phone' => $data['phone'],
            'email' => $data['email'] ??null,
            'status' =>$data['status'],
        ]);
    }

    public function updateStore( $store, $data)
    {
        $updateData = [
            'name' => $data['name'],
            'importance_level' => $data['importance_level'],
            'website_url' => $data['website_url'] ?? null,
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'status' => $data['status'],
        ];

        if (isset($data['logo'])) {
            $updateData['logo'] = $data['logo'];
        }

        $store->update($updateData);

        return $store;
    }

    public function deleteStore($store)
    {
        $branchIds = $store->branches()->pluck('id');
        Appointment::whereIn('branch_id', $branchIds)->delete();
        $store->branches()->delete();
        return $store->delete();
    }

    public function changeStatus($store)
    {
        $store = $store->update([
            'status' => $store->status == '1' ? '0' : '1',
        ]);
        return $store;
    }
}
