<?php

namespace App\Repositories\Dashboard;

use App\Models\Day;

class DayRepository
{
    public function getDays()
    {
        $days = Day::select('id','day')->get();
        return $days;
    }
}
