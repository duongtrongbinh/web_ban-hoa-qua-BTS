<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;


class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {}
        public function viewAny(User $user): bool
        {
            return $user->checkPermission(config('permission.access.list-user'));
            
        }
    
        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user): bool
        {
            // return $user->checkPermission(config('permission.access.list-user'));
            
        }

        
    public function create(User $user): bool
    {
        return $user->checkPermission(config('permission.access.list-role'));
        
    }
    
}
