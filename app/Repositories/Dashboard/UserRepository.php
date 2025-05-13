<?php

namespace App\Repositories\Dashboard;

use App\Models\User;

class UserRepository
{
    public function __construct()
    {
        //
    }

    public function getUsers() {
        return User::get();
    }
    public function getUser($id) {
        return User::find($id);
    }

    public function createUser($data) {
        return User::create($data);
    }

    public function deleteUser($user) {
        return $user->delete();
    }

    public function changeStatus($user) {
        $user = $user->update([
            'status' => $user->status == '1'? '0' : '1',
         ]);
         return $user;
    }
}
