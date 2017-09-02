<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $table = 'appsetting';

    protected $fillable = ['name' , 'setting_id' , 'value'];

    public function parent(){
    	return $this->belongsTo(\App\Admin\SettingList::class, 'id');
    }
}
