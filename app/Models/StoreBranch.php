<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreBranch extends Model
{
    protected $fillable = ['neighborhood_id', 'store_id', 'address', 'location'];
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }

    public function days()
    {
        return $this->belongsToMany(Day::class, 'appointments', 'branch_id', 'day_id')
                    ->withPivot('open_time', 'close_time')
                    ->withTimestamps();
    }
}
