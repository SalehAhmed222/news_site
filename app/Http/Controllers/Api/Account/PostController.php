<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class PostController extends Controller
{
    public function getUserPosts()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return apiResponse(404, 'User Not Found  ');
        }
        $posts = $user->posts()->active()->activeCategory()->get();
        if ($posts->count() > 0) {
            return apiResponse(201, 'This is Posts of user', new PostCollection($posts));
        }
        return apiResponse(404, 'Posts Not Found');
    }



    public function storeUserPost(Request $request)
    {
        try {
            DB::beginTransaction();


            //upload post
            $post = auth()->user()->posts()->create($request->except(['images']));

            //uploades images using optimiz in Utils file
            //first way
            // $imageManger =new ImageManger;
            // $imageManger->uplaodImages($request ,$post);
            //second way and the best way static method

            ImageManger::uplaodImages($request, $post);


            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');

            return apiResponse(201, 'Post of user stored  successfully!');
        } catch (\Exception $e) {
            Db::rollBack();
            Log::error("error store  user posts" . $e->getMessage());
            return apiResponse(400, 'Oop somthing wrong!');
        }
    }


    public function destroyUserPost($post_id)
    {



        $user = auth()->user();

        $post = $user->posts()->where('id', $post_id)->first();
        if (!$post) {
            return apiResponse(404, 'Post not found');
        }

        ImageManger::deleteImage($post);
        $post->delete();
        return apiResponse(201, 'Post of User deleted Successfully!');
    }

    public function getPostComments($post_id)
    {
        $user = auth()->user();

        $post = $user->posts()->where('id', $post_id)->first();
        if (!$post) {
            return apiResponse(404, 'Post not found');
        }
        if ($post->comments->count() > 0) {
            return apiResponse(201, 'this is comments of this post', CommentResource::collection($post->comments));
        }

        return apiResponse(404, 'Comments not found yet!');
    }

    public function updateUserPost(PostRequest $request, $post_id)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $post = $user->posts()->where('id', $post_id)->first();
            if (!$post) {
                return apiResponse(404, 'Post not found');
            }

            $post->update($request->except(['images', '_method'])); //post_id

            //check from post have images
            if ($request->hasFile('images')) {


                ImageManger::deleteImage($post);
                //store new images
                ImageManger::uplaodImages($request, $post);

                DB::commit();
                return apiResponse(201, 'Post updated  successfully!');
            }
        } catch (\Exception $e) {
            Db::rollBack();
            Log::error("error update   posts" . $e->getMessage());
            return apiResponse(400, 'Oop somthing wrong!');
        }
    }




    public function storeComments(CommentRequest $request)
    {

        //this for Rate Limiter scond way

        if(RateLimiter::tooManyAttempts($request->ip(),2)){
            $time=RateLimiter::availableIn($request->ip());

            return apiResponse(429,'too many attempts ,Try again after  '. $time . '  seconds');
        }
        RateLimiter::increment($request->ip());

        $remaining=RateLimiter::remaining($request->ip(),2);




        $post = Post::find($request->post_id);
        if (!$post) {
            return apiResponse(404, 'Post not found');
        }
        $comment = $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip(),

        ]);
        if (!$comment) {
            return apiResponse(400, 'Try Again Latter!');
        }
        //belongs to notification

        // //for dont allows for user that write post when write comment on your post  dont send notification
        if(auth()->user()->id != $post->user->id){
            $post->user->notify(new NewCommentNotify($comment ,$post));
        }

        return apiResponse(201, 'Comment Created Successfully!!',['remaining'=>$remaining]);
    }
}
