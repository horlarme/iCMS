<?php

if (!function_exists('setting')) {
    function setting($name, $parent, $value = null)
    {
        $setting = new \App\Http\Controllers\AppSettingController();
        return $setting->setting($name, $parent, $value = null);
    }
}

if (!function_exists('settingParent')) {
    function settingParent($name, $value)
    {
        return \App\Admin\SettingList::where($name, $value)->firstOrFail();
    }
}
