<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'title',
        'target_amount',
        'current_amount',
        'deadline',
        'category',
        'description',
        'is_completed',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'deadline' => 'date',
        'is_completed' => 'boolean',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function getProgressAttribute()
    {
        return ($this->current_amount / $this->target_amount) * 100;
    }
}
