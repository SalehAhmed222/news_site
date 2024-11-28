<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'small_desc',
    ];

    public function posts(){
        return $this->hasMany(Post::class ,'category_id');
    }

    //local scope
    public function scopeActive($query){
        return $query->where('status' ,1);
   }

   public function sluggable(): array
   {
       return [
           'slug' => [
               'source' => 'name'
           ]
       ];
   }
   public function status(){
    return $this->status == 1?'Active':'Not Active';
}
}
