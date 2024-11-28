<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;

class GeneralController extends Controller
{

    public function getPosts()
    {

        $query = Post::query()->with(['user', 'category', 'images', 'admin'])->activeUser()->activeCategory()->active();

        if (request()->query('keyword')) {
            $query->where('name', 'LIKE', '%' . request()->query('keyword') . '%');
        }
        $all_posts = clone $query->latest()->paginate(4);

        $latest_posts = $this->latestPots(clone $query);
        $oldest_posts = $this->oldestPosts(clone $query);
        $popular_posts = $this->popularPosts(clone $query);
        $most_read_posts = $this->mostReadPosts(clone $query);

        $categories_with_posts = $this->categoryWithPosts();

        $data = [
            'all_posts' => (new PostCollection($all_posts))->response()->getData(true),
            'latest_posts' =>  PostResource::collection($latest_posts),
            'categories_with_posts' => CategoryResource::collection($categories_with_posts),
            'oldest_posts' => PostResource::collection($oldest_posts),
            'popular_posts' => PostResource::collection($popular_posts),
            'most_read_posts' => PostResource::collection($most_read_posts),
        ];
        return apiResponse(200, 'this is post', $data);
    }

    public function latestPots($query)
    {
        $latest_posts = $query->latest()->take(4)->get();
        if (!$latest_posts) {
            return apiResponse(404, 'post not found');
        }
        return $latest_posts;
    }
    public function oldestPosts($query)
    {
        $oldest_posts = $query->oldest()->take(3)->get();
        if (!$oldest_posts) {
            return apiResponse(404, 'post not found');
        }
        return $oldest_posts;
    }
    public function popularPosts($query)
    {
        $popular_posts = $query->withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        if (!$popular_posts) {
            return apiResponse(404, 'post not found');
        }
        return $popular_posts;
    }
    public function mostReadPosts($query)
    {
        $most_read_posts = $query->orderBy('num_of_views', 'desc')->take(3)->get();
        if (!$most_read_posts) {
            return apiResponse(404, 'post not found');
        }
        return $most_read_posts;
    }
    public function categoryWithPosts()
    {
        $categories = Category::active()->get();
        $categories_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->take(4)->get();
            return $category;
        });
        return $categories_with_posts;
        if (!$categories_with_posts) {
            return apiResponse(404, 'post not found');
        }
    }
    public function showPosts($slug)
    {

        $post = Post::with(['user', 'category', 'images', 'admin'])->active()->activeUser()->activeCategory()->whereSlug($slug)->first();
        if (!$post) {
            return apiResponse(404, 'Post Not Found');
        }
        return apiResponse(200, 'this is posts', PostResource::make($post));
    }



    public function showPostComment($slug)
    {
        $post = Post::active()->activeUser()->activeCategory()->whereSlug($slug)->first();
        if (!$post) {
            return apiResponse(404, 'Post Not Found');
        }
        $comment = $post->comments;
        if (!$comment) {
            return apiResponse(404, 'Comments Not Found');
        }
        return apiResponse(200, 'this is comments of this post', new CommentCollection($comment));
    }



    public function searchPosts(){
        $query = Post::query()->with(['user', 'category', 'images', 'admin'])->activeUser()->activeCategory()->active();

        if (request()->query('keyword')) {
            $query->where('name', 'LIKE', '%' . request()->query('keyword') . '%');
        }
        $all_posts = clone $query->latest()->paginate(4);


        return apiResponse(200,'this is search of post',new PostCollection($all_posts));
    }
}

// response()->json([
//     'data'=>PostResource::make($post),
//     'status'=>200,
// ]) ;
