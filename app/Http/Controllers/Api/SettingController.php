<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\RelatedNewsSites;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSettings(){
        $setting=Setting::first();
        $related_site=$this->relatedSite();
        $data=[
            'related_site'=>$related_site,
            'settings'=>new SettingResource($setting),

        ];



        if(!$setting){
            return apiResponse(404,'settings is empty');
        }
        return apiResponse(200,'this is settings site',$data);
    }
    public function relatedSite(){
        $related_site=RelatedNewsSites::select('name','url')->get();
        if(!$related_site){
            return apiResponse(404,'Related News Site is empty');
        }
        return $related_site;
    }
}
