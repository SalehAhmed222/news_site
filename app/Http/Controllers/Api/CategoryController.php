<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(){
        $categories=Category::active()->get();
        if(!$categories){
            return apiResponse(404,'Categories Not Found');
        }
        return apiResponse(200,'all categories',new CategoryCollection($categories));




    }

    public function getCategoryPosts($slug){
        $category=Category::active()->whereSlug($slug)->first();
        if(!$category){
            return apiResponse(404,'category not found');
        }
        $posts=$category->posts;
      
        return apiResponse(200,'this is Category Posts',new PostCollection($posts));
    }
}
