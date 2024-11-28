<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site_name'=>$this->site_name,
            'favicon'=>asset($this->favicon),
            'logo'=>asset($this->logo),
            'facebook'=>$this->facebook,
            'instagram'=>$this->instagram,
            'twitter'=>$this->twitter,
            'youtube'=>$this->youtube,
            'address'=>$this->street.','.$this->city.','.$this->country,
            'email'=>$this->email,
            'small_desc'=>$this->small_desc,
            'phone'=>$this->phone,



        ];
    }
}
