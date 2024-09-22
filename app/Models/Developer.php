<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ratio'
    ];

    protected $appends = [
        'capacity',
        'remaining_capacity',
        'hours_until_next_availability'
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getCapacityAttribute(): int
    {
        //Developer’ların haftalık 45 saat çalıştığı varsayılıyor.
        return $this->ratio * 45;
    }

    public function getRemainingCapacityAttribute(): int
    {
        $totalCost = $this->tasks()->selectRaw('SUM(difficulty * duration) AS total_cost')->get()[0]?->total_cost ?? 0;

        return $this->capacity - $totalCost;
    }

    public function getHoursUntilNextAvailabilityAttribute(): float
    {
        $totalCost = $this->tasks()->selectRaw('SUM(difficulty * duration) AS total_cost')->get()[0]?->total_cost ?? 0;
        return $totalCost / $this->ratio;
    }
}
