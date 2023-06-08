<?php

namespace App\Policies;

use App\Models\Code;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CodePolicy
{
    use HandlesAuthorization;

    // public function before(?User $user, $ability)
    // {
    //     return optional($user)->isAdmin();
    // }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return !$user 
            ? Response::allow() 
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can view the model.
     * 
     * Allows Guest viewing
     *
     * @param  \App\Models\User  $user  Optional
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Code $code)
    {
        return !$user || optional($user)->id == $code->user_id 
            ? Response::allow()
            : Response::denyWithStatus(403);
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
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Code $code)
    {
        // 
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Code $code)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Code $code)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Code $code)
    {
        //
    }
}
