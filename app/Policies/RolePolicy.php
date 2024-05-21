<?php

namespace App\Policies;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    
    public function update(User $user) : Response{
        return $user->role->name === 'Admin' ? Response::allow() : Response::deny('Unauthorized action');

    }

    public function destroy(User $user) : Response{
        return  in_array(auth()->user()->role->name , ['Admin' , 'Sub-Admin'])? Response::allow() : Response::deny('Cannot Perform this action');
    }

}
