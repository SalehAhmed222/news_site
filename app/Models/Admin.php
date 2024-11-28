<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory , Notifiable;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'status',
        'role_id',


    ];//this best way for protected
    //another ways for protected guarded
    //protected $guarded = []

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];
    public function posts(){
        return $this->hasMany(Post::class , 'admin_id');
    }
    public function authorization(){
        return $this->belongsTo(Authorization::class,'role_id');
    }

    //this function related premession in Provider AuthServicesProvider
    public function hasAccess($config_permession){
        $authorizations=$this->authorization;
        if(!$authorizations){
            return false;
        }
        foreach ($authorizations->permessions as $permession) {
            if($config_permession == $permession ??false){
                return true;
            }
        }
    }

  //customize rename channels
    /**
     * The channels the admin receives notification broadcasts on.
     */

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'admins.'.$this->id;
    }

    public function status(){
        return $this->status == 1?'Active':'Not Active';
    }
}
