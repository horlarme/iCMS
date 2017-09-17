<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'gender', 'website', 'twitter', 'facebook', 'instagram', 'country', 'state', 'mobile', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Generate default image for the user based on their gender
     * @param $gender String
     * @return String The image name
     */
    public function assignImage($gender)
    {
        switch ($gender) {
            case 'female':
                return "avatar-female.png";
                break;
            default:
                return "avatar-male.png";
                break;
        }
    }

    /**
     * Getting the role of a user
     */
    public function role()
    {
        return $this->hasOne(\App\Roles::class, 'user_id');
    }
}
