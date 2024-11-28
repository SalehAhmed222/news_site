<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::active()->with('images')->latest()->paginate(9); //images is function relaetion between Model Image and Post
        //paginate to select num of posts
        //latest  to come posts from new to old
        $greatest_num_of_views = Post::active()->orderBy('num_of_views', 'desc')->take(3)->get();
        //orderBY is come num_of_views from model Post and oreder from large to small
        $oldest_news = Post::active()->oldest()->take(3)->get();
        $greatest_posts_comment = Post::active()->withCount('comments')
        ->orderBy('comments_count', 'desc')
        ->take(3)
        ->get();

        $categories = Category::has('posts','>=',2)->active()->get(); //collection for i can do map on categories
        $categories_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });





        return view('frontend.index', compact('posts', 'greatest_num_of_views', 'oldest_news', 'greatest_posts_comment', 'categories_with_posts'));  //other way for call posts without compact  ,['posts' =>$posts]
    }
}
