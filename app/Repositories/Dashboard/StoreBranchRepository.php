<?php

namespace App\Repositories\Dashboard;

class StoreBranchRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function storeBranch($store, $data) {
        return $store->branches()->create($data);
    }

     public function deleteStoreBranches($store) {
        return $store->branches()->delete();
    }
}