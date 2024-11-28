<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Notifications\NewCommentNotify;

class PostController extends Controller
{
    public function show($slug)
    {
        $mainPost = Post::active()->with(['comments' => function ($query) {
            $query->latest()->limit(2);
        }])->whereSlug($slug)->first();

    if (!$mainPost) {
        return abort(404, 'Post not found');
    }

        $category = $mainPost->category;
        $posts_belongs_to_category = $category->posts()->select('id', 'name', 'slug')->active()->limit(5)->get();


        $mainPost->increment('num_of_views'); //for calc num of views
        return view('frontend.show', compact('mainPost', 'posts_belongs_to_category'));
    }

    public function getAllComments($slug)
    {
        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->active()->with('user')->get();
        return response()->json($comments);
    }

    public function addNewComment(CommentRequest $request)
    {
        $request->validated();



        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'ip_address' => $request->ip(),

        ]);

        //belongs to notification
        $post=Post::findOrFail($request->post_id);
        //for dont allows for user that write post when write comment on your post  dont send notification
        if(auth()->user()->id != $post->user->id){
            $post->user->notify(new NewCommentNotify($comment ,$post));
        }








        $comment->load('user');
        if (!$comment) {
            return response()->json([
                "data" => 'operation failed',
                "status" => 403
            ]);
        }
        return response()->json([
            "msg" => "comment added successfully!!!!",
            "comment" => $comment,
            "status" => 201,


        ]);
    }
}
