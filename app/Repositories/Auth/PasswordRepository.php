<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Hash;

class PasswordRepository
{
    public $code_after_send;
    public function __construct()
    {
        $this->code_after_send = new Otp;
    }

    public function getAdmin($email)
    {
        $admin = Admin::where('email', $email)->first();
        return $admin;
    }

    public function updateAdminPasssword($email)
    {
        $admin = Admin::where('email', $email)->first();
        return $admin;
    }

    public function verifyCode($data)
    {
        $code = $this->code_after_send->validate($data['email'], $data['code']);
        return $code;
    }

    public function resetPassword($data)
    {
        $admin = self::getAdmin($data['email']);
        $admin->update([
            'password' => Hash::make($data['password']),
        ]);
        return $admin;
    }
}