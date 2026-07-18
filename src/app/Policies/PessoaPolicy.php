<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pessoa;

class PessoaPolicy
{
    public function viewAny(User $user): bool
    {
        return True;
    }

    public function view(User $user, Pessoa $pessoa): bool
    {
        return $user->role === 'admin' || $user->id === $pessoa->user_id;
    }

    public function create(User $user): bool
    {
        return True;
    }

    public function update(User $user, Pessoa $pessoa): bool
    {
        return $user->role === 'admin' || $user->id === $pessoa->user_id;
    }

    public function delete(User $user, Pessoa $pessoa): bool
    {
        return $user->role === 'admin'|| $user->id === $pessoa->user_id;
    }
}
