<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'target_amount',
        'current_amount',
        'start_date',
        'target_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'target_date' => 'date',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProgressAttribute()
    {
        if ($this->target_amount == 0) {
            return 0;
        }

        return ($this->current_amount / $this->target_amount) * 100;
    }
}
