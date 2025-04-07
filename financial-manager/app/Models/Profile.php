<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'initial_balance',
    ];

    protected $casts = [
        'initial_balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function fixedExpenses()
    {
        return $this->hasMany(FixedExpense::class);
    }

    public function fixedIncomes()
    {
        return $this->hasMany(FixedIncome::class);
    }
}
