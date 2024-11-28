<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'ip_address',
        'status',
        'user_id',
        'post_id',
        'updated_at',
        'created_at',





    ];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class , 'post_id');
    }

}
