<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, User $user_to_update) : Response{
        if($user->role->name == 'Admin'){
            return Response::allow();
        }

        if($user->id == $user_to_update->id){
            return Response::allow();
        }

        return Response::deny('Unauthorized Action');
    }
}
