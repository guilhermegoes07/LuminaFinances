<?php

namespace App\Policies;

use App\Models\RecurringTransaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecurringTransactionPolicy
{
    use HandlesAuthorization;

    public function view(User $user, RecurringTransaction $recurringTransaction)
    {
        return $user->id === $recurringTransaction->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, RecurringTransaction $recurringTransaction)
    {
        return $user->id === $recurringTransaction->user_id;
    }

    public function delete(User $user, RecurringTransaction $recurringTransaction)
    {
        return $user->id === $recurringTransaction->user_id;
    }
}
