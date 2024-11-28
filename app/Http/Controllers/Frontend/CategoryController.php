<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::active()->whereSlug($slug)->first();
        if(!$category){
            return redirect()->back()->with('warning','Try again !');
        }
        $posts = $category->posts()->paginate(9);
        return view('frontend.category-posts' ,compact('posts' ,'category'));
    }
}
