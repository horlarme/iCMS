<?php

namespace App\Http\Controllers;

use App\Roles;

class roleController extends Controller
{
    /**
     * This function assign role to a user if the role parameter is returned
     * But return the role of the user if the role parameter is not parsed
     * @param int $user_id The id of the user
     * @param int $role The role to be given to the user
     */
    public function userRole($user_id, $role = null)
    {
        //Check for role or assign role?
        if (is_null($role)) {
            return Roles::where('user_id', $user_id)->with('role')->firstOrFail()->role->name;
        } else {
            //Assign Role
            //Checking if the user has a role already
            if (!$this->hasRole($user_id)) {
                Roles::create([
                    'user_id' => $user_id,
                    'role_id' => $role
                ]);
            }
        }
    }

    /**
     * Check if the user already has a role
     */
    public function hasRole($user_id)
    {
        if (count(Roles::where('user_id', $user_id)->get()) < 1)
            return false;
    }

}
