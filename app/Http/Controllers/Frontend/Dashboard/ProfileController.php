<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->active()->latest()->with(['images'])->get();

        return view('frontend.dashboard.profile', compact('posts'));
    }

    public function postStore(PostRequest $request)
    {

        $request->validated();

        try {
            DB::beginTransaction();
            $this->commentAble($request);

            //upload post
            $post = auth()->user()->posts()->create($request->except(['_token', 'images']));

            //uploades images using optimiz in Utils file
            //first way
            // $imageManger =new ImageManger;
            // $imageManger->uplaodImages($request ,$post);
            //second way and the best way static method

            $imageManger = ImageManger::uplaodImages($request, $post);


            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');


        } catch (\Exception $e) {
            Db::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }

        Session::flash('success', 'Added Post successfully!!!');

        return redirect()->back();
    }

    //function for delete posts
    public function deletePost(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        if (!$post) {
            return abort(404);
        }
        //delete images in pots
        ImageManger::deleteImage($post);

        $post->delete();

        return redirect()->back()->with('success', ' deleted this post successfully');
    }

    //function for display comments for post
    public function getComments($id)
    {
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        if (!$comments) {
            return response()->json([
                'data' => null,
                'msg' => 'No Commments',
            ]);
        }
        return response()->json([
            'data' => $comments,
            'msg' => 'contain comments'
        ]);
    }




    public function showEditForm($slug)
    {

        $post = Post::with(['images'])->whereSlug($slug)->first();
        if (!$post) {
            return abort(404);
        }
        return view('frontend.dashboard.edit-post', compact('post'));
    }


    public function updatePost(PostRequest $request)
    {

        $request->validated();
       try{
        DB::beginTransaction();
        $post = Post::findOrFail($request->post_id);
        $this->commentAble($request);
        $post->update($request->except(['_token', 'images', 'post_id'])); //post_id

        //check from post have images
        if ($request->hasFile('images')) {


            ImageManger::deleteImage($post);
            //store new images
            ImageManger::uplaodImages($request, $post);

            DB::commit();
        }
       }catch (\Exception $e) {
        Db::rollBack();
        return redirect()->back()->withErrors(['errors', $e->getMessage()]);
    }


        Session::flash('success', 'Post Updated Doneeeee!');
        return redirect()->route('frontend.dashboard.profile');
    }

    private function commentAble($request)
    {
        $request->comment_able == "on" ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
    }

    public function deletePostImage(Request $request, $image_id)
    {

        $image = Image::find($request->key);
        if (!$image) {
            return response()->json([
                'status' => 201,
                'msg' => 'image not found',
            ]);
        }

        ///delete image from local

        ImageManger::deleteImageFromLocal($image->path);

        //deleteimage from db
        $image->delete();

        return response()->json([
            'status' => 201,
            'msg' => 'image deleted succfully!!!!!',
        ]);
    }
}
