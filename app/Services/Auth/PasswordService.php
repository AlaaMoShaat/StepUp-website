<?php

namespace App\Services\Auth;

use App\Notifications\SendCodeNotify;
use App\Repositories\Auth\PasswordRepository;

class PasswordService
{
    protected $passwordRepository;
    public function __construct(PasswordRepository $passwordRepository)
    {
        $this->passwordRepository = $passwordRepository;
    }

    public function sendCode($email)
    {

        $admin = $this->passwordRepository->getAdmin($email);
        if (!$admin) {
            return false;
        }
        $admin->notify(new SendCodeNotify());
        return $admin;
    }

    public function verifyCode($data)
    {
        $code = $this->passwordRepository->verifyCode($data);
        return $code->status;
    }

    public function resetPassword($data)
    {
        $admin = $this->passwordRepository->getAdmin($data['email']);
        if (!$admin) {
            return false;
        }
        return $this->passwordRepository->resetPassword($data);
    }
}
