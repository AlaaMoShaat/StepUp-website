<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchOpeningHour extends Model
{
    protected $fillable = ['branch_id', 'opening_hour_id'];
    public $timestamps = false;

    public function branch()
    {
        return $this->belongsTo(StoreBranch::class, 'branch_id');
    }

    public function openingHour()
    {
        return $this->belongsTo(OpeningHour::class, 'opening_hour_id');
    }
}