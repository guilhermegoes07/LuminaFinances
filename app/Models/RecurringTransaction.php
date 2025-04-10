<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'amount',
        'frequency',
        'start_date',
        'end_date',
        'last_processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'last_processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
