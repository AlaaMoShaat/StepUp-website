<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\RoleRepository;

class RoleService
{
    protected $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getRole($id)
    {
        return $this->roleRepository->getRole($id);
    }
    public function getRoles()
    {
        return $this->roleRepository->getRoles();
    }

    public function createRole($request)
    {
        $role = $this->roleRepository->createRole($request);
        return $role;
    }

    public function updateRole($request, $id)
    {
        $role = $this->roleRepository->getRole($id);
        if (!$role) {
            return false;
        }
        return $this->roleRepository->updateRole($request, $role);
    }

    public function deleteRole($id)
    {
        $role = self::getRole($id);
        if (!$role || $role->admins->count() > 0) {
            return false;
        }
        return $this->roleRepository->deleteRole($role);
    }
}