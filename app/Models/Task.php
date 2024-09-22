<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_id',
        'provider',
        'foreign_id',
        'difficulty',
        'duration',
        'work_duration',
        'delivery_duration'
    ];

    protected $appends = [
        'cost'
    ];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function getCostAttribute(): int
    {
        return $this->difficulty * $this->duration;
    }
}
