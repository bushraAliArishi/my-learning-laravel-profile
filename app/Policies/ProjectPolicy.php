<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    public function edit(User $user, Project $project): bool
    {
        return Auth::check() && $user->role === 'admin';
    }
}
