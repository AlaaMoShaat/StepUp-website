<?php

namespace App\Repositories\Dashboard;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminRepository
{
    public function __construct()
    {
        //
    }

    public function getAdmins()
    {
        return Admin::where('id', '!=', Auth::guard('admin')->user()->id)->orderBy('id', 'desc')->paginate(6);
    }

    public function getAdmin($id)
    {
        return Admin::find($id);
    }

    public function createAdmin($data)
    {
        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'role_id' => $data['role_id'],
        ]);
        return $admin;
    }

    public function updateAdmin($data, $admin)
    {
        $admin = $admin->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'password' => $data['password'] ?? $admin->password,
            'phone' => $data['phone'],
            'role_id' => $data['role_id'],
        ]);
        return $admin;
    }
    public function deleteAdmin($admin)
    {
        return $admin->delete();
    }

    public function changeStatus($admin)
    {
        $admin = $admin->update([
            'status' => $admin->status == '1' ? 0 : 1,
        ]);
        return $admin;
    }
}