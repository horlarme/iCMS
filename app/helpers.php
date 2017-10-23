<?php

if (!function_exists('setting')) {
    function setting($name, $parent, $value = null)
    {
        $setting = new \App\Http\Controllers\AppSettingController();
        return $setting->setting($name, $parent, $value = null);
    }
}

if (!function_exists('settingParent')) {
    function settingParent($value)
    {
        return \App\Admin\SettingList::where('name', $value)->firstOrFail();
    }
}

if (!function_exists('userRole')) {
    function userRole($user_id, $value = null)
    {
        $role = new \App\Http\Controllers\RoleController();
        return $role->userRole($user_id);
    }
}

if(!function_exists('getUser')){
    /**
     * Get a particular information about the current logged in user
     * Example: getUser('id') provides the ID of the current user
     * @param mixed $what What information about the user should be retrieved
     * @return mixed
     */
    function getUser($what){
        if (auth()->check())
            return Auth()->user()->id;
        return false;
    }
}

if (!function_exists('category')) {
    /**
     * Get Category using its name
     * or
     * Get All categories
     * @param $name
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    function category($name = false)
    {
        $c = new \App\Category();
        if ($name) {
            return $c->category($name);
        }
        return $c->orderBy('name')->get();
    }
}

if (!function_exists('categories')) {
    /**
     * Provide all the list of the categories that are not deleted
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    function categories()
    {
        return category();
    }
}

if (!function_exists('getApp')) {
    function getApp($value)
    {
        return setting($value, settingParent('app'));
    }
}

if(!function_exists('posts')){
    function posts($limit = false){
        if($limit){
        return \App\Posts::orderBy('id')->limit($limit)->get();
        }
        return \App\Posts::orderBy('id');
    }
}