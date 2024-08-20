<?php

namespace Modules\User\Observers;

use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function creating(User $user)
    {
        $user->created_by = Auth::id();
    }

    public function updating(User $user)
    {
        $user->updated_by = Auth::id();
    }

    public function deleting(User $user)
    {
        $user->deleted_by = Auth::id();
    }
}
