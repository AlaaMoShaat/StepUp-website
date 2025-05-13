<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\UserService;
use App\Http\Requests\Dashboard\UserRequest;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index');
    }
    public function getAllUsers() {
        return $this->userService->getUsersForDataTable();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->only([
            'name', 'email', 'password', 'status'
        ]);
        $user = $this->userService->createUser($data);

        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->deleteUser($id);
        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id) {
        $user = $this->userService->changeStatus($id);
        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $user = $this->userService->getUser($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $user], 200);
    }
}
