<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Roles
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function subs_only($user){
        if ($user->role == 'subscriber') {
            return true;
        }
            return false;
    }
     public function editor_only($user){
        if ($user->role == 'editor') {
            return true;
        }
            return false;
    }
    public function admin_only($user){
        if ($user->role == 'admin') {
            return true;
        }
            return false;
    }
}
