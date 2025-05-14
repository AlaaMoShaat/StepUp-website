<?php

namespace App\Repositories\Dashboard;

use App\Models\Appointment;

class StoreBranchRepository
{
    public function storeBranch($store, $data)
    {
        return $store->branches()->create($data);
    }

    public function syncAppointments($branch, $daysData)
    {
        $appointments = [];

        foreach ($daysData as $dayId => $dayData) {
            if ($dayData['enabled'] ?? false) {
                $appointments[$dayId] = [
                    'open_time' => $dayData['open_time'],
                    'close_time' => $dayData['close_time'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        $branch->days()->sync($appointments);
    }

    public function deleteStoreBranches($store)
    {
        $branchIds = $store->branches()->pluck('id');
        Appointment::whereIn('branch_id', $branchIds)->delete();
        return $store->branches()->delete();
    }
}
