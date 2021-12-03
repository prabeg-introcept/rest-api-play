<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Worklog;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklogPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Worklog $worklog)
    {
        return $user->id === $worklog->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Worklog $worklog)
    {
        return $user->id === $worklog->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Worklog $worklog)
    {
        return $user->id === $worklog->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Worklog $worklog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Worklog $worklog)
    {
        //
    }
}
