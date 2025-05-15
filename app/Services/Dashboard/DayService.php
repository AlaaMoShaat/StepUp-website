<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\DayRepository;

class DayService
{
    public function __construct(protected DayRepository $dayRepository){}

    public function getDays()
    {
        $days = $this->dayRepository->getDays();
        if (!$days) {
            return abort(404);
        }
        return $days;
    }
}
