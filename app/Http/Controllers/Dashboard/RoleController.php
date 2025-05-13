<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\RoleService;
use App\Http\Requests\Dashboard\RoleRequest;

class RoleController extends Controller
{
    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleService->createRole($request);
        if (!$role) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }

        return redirect()->route('dashboard.roles.index')->with('success', __('messages.success_msg'));
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
        $role = $this->roleService->getRole($id);
        if (!$role) {
            return redirect()->back()->with('error', __('messages.not_found'));
        }
        return view('dashboard.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = $this->roleService->updateRole($request, $id);
        if (!$role) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->roleService->deleteRole($id);
        if (!$role) {
            return response()->json(['status' => false, 'message' => __('messages.delete_rlated_admins')]);
        }

        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }
}