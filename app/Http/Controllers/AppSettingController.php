<?php

namespace App\Http\Controllers;

use App\Admin\AppSetting;
use App\Admin\SettingList;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($setting, Request $request)
    {
        $setting = \App\Admin\SettingList::where('name', $setting)->firstOrFail();
        return view('setting.' . $setting->name, compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AppSetting $appSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AppSetting $appSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function update($setting, Request $request, AppSetting $appSetting)
    {
        //Return json
        // header('content-type: application/json');
        //Configuring the setting to be updated
        //Value to be given
        $name = $request->get('update');
        $value = $request->get('value');
        $parent = SettingList::where('name', $setting)->firstOrFail();

        /**
        * This checks if the value is already in the database
        * And if it returns true, then we only need to update and not create
        */
        // var_dump($this->hasValue($name, $parent));exit;
        if($this->hasValue($name, $parent) != null || false){
            $this->setting($name, $parent, $value);
        }else{
            $this->createSetting($name, $parent, $value);
        }
            return json_encode(['response' => 'true']);
    }

    public function hasValue($name, SettingList $parent){
        return (\App\Admin\AppSetting::where('setting_id', $parent->id)->where('name', $name)->first());
        }

    public function setting($name, SettingList $parent, $value = null){
        //If the value is null, then return the value of the specified name
        if(is_null($value)){
            if($this->hasValue($name, $parent) != null || false){
                return $this->hasValue($name, $parent)->value;
            }else{
                return false;
            }
        }
        //Else, update the setting with the value specified
        else{
            //If the vlaue already ecist in the database
            //We will need to update the value
                return AppSetting::where('name', $name)
                        ->where('setting_id', $parent->id)
                        ->update(['value' => $value]);
        }
    }

    public function createSetting($name, SettingList $parent, $value){
        return AppSetting::create([
                            'name' => $name,
                            'setting_id' => $parent->id,
                            'value' => $value
                            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppSetting $appSetting)
    {
        //
    }
}
