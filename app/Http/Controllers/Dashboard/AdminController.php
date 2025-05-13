<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\RoleService;
use App\Services\Dashboard\AdminService;
use App\Http\Requests\Dashboard\AdminRequest;

class AdminController extends Controller
{
    protected $adminService, $roleService;
    public function __construct(AdminService $adminService, RoleService $roleService)
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;
    }
    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->only(['name', 'email', 'password', 'role_id', 'status', 'phone']);
        $admin = $this->adminService->createAdmin($data);
        if (!$admin) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        $roles = $this->roleService->getRoles();
        if ($id == auth('admin')->user()->id) {
            abort(404);
        }
        return view('dashboard.admins.edit', compact(['admin', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'email', 'password', 'role_id', 'status', 'phone']);
        $admin = $this->adminService->updateAdmin($data, $id);
        if (!$admin) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = $this->adminService->deleteAdmin($id);
        if (!$admin) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id)
    {
        $admin = $this->adminService->changeStatus($id);
        if (!$admin) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        $admin = $this->adminService->getAdmin($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $admin], 200);
    }
}