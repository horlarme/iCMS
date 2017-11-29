<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The User's Role not the Role List
 * Class Roles
 * @package App
 */
class Roles extends Model
{
    /**
     * Setting the table to be used
     */
    protected $table = 'userrole';

    /**
     * Fillables
     */
    protected $fillable = ['role_id', 'user_id'];

    /**
     * Pointing user role to its parent
     */
    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }
}
