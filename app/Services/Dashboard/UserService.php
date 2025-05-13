<?php

namespace App\Services\Dashboard;

use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\UserRepository;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($id) {
        $user = $this->userRepository->getUser($id);
        if (!$user) {
            abort(404);
        }
        return $user;
    }

    public function getUsersForDataTable() {
        $users = $this->userRepository->getUsers();
        return DataTables::of($users)->addIndexColumn()
        ->addColumn('status', function($user) {
            return view('dashboard.users.datatables.statusFeild', compact('user'));
        })
        ->addColumn('actions', function ($user) {
            return view('dashboard.users.datatables.actions', compact('user'));
        })
        ->make(true);
    }

    public function createUser($data) {
        $user = $this->userRepository->createUser($data);
        return $user ?? false;
    }

    public function deleteUser($id) {
        $user = self::getUser($id);
        if (!$user) {
            abort(404);
        }
        $user = $this->userRepository->deleteUser($user);
        return $user?? false;
    }

    public function changeStatus($id) {
        $user = self::getUser($id);
        $user = $this->userRepository->changeStatus($user);
        return $user?? false;
    }
}