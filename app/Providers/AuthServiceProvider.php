<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\Goal;
use App\Models\RecurringTransaction;
use App\Policies\TransactionPolicy;
use App\Policies\GoalPolicy;
use App\Policies\RecurringTransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Transaction::class => TransactionPolicy::class,
        Goal::class => GoalPolicy::class,
        RecurringTransaction::class => RecurringTransactionPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
