<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;
    protected $fillable = [
        'role',
        'permessions',
        'role_id',
    ];

    public function getpermessionsAttribute($permessions){
        return json_decode($permessions);

    }
    public function admins(){
        return $this->hasMany(Admin::class,'role_id');

    }
}
