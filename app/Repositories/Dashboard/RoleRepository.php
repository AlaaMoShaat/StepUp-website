<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;

class RoleRepository
{
    public function __construct() {}

    public function getRole($id)
    {
        return Role::find($id);
    }
    public function getRoles()
    {
        return Role::orderBy('id', 'desc')->latest()->paginate(6);
    }
    public function createRole($request)
    {
        $role = Role::create([
            'role' => [
                'ar' => $request->role['ar'],
                'en' => $request->role['en'],
            ],
            'permession' => json_encode($request->permessions),
        ]);
        return $role;
    }

    public function updateRole($request, $role)
    {
        $role = $role->update([
            'role' => $request->role, // no problem
            'permession' => json_encode($request->permessions),
        ]);
        return $role;
    }
    public function deleteRole($role)
    {
        return $role->delete();
    }
}