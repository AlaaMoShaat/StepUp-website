<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\StoreBranchRepository;

class StoreBranchService
{
    protected $storeBranchRepository;
    public function __construct(StoreBranchRepository $storeBranchRepository)
    {
        $this->storeBranchRepository = $storeBranchRepository;
    }

    public function storeBranch($store, $data) {
        $branch = $this->storeBranchRepository->storeBranch($store, $data);
        if(!$branch) {
            return false;
        }
        return $branch;
    }
}