<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */


       //this function for protects permessions from admin write routes to open pages
    public function __construct()
    {
        $this->middleware('can:posts');

    }
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;


        $posts = Post::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        });
        $posts = $posts->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $post = Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images']));
            ImageManger::uplaodImages($request, $post, null);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollback();


            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->back()->with('success', 'Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $post=Post::with('comments')->findOrFail($id);
        return view('admin.posts.show',compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $post=Post::findOrFail($id);
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();
        try{
         DB::beginTransaction();
         $post = Post::findOrFail($id);

         $post->update($request->except(['_token', 'images'])); //post_id

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
         return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        ImageManger::deleteImage($post);
        $post->delete();
        Session::flash('success', 'Post deleted successfully!');

        return redirect()->route('admin.posts.index');
    }
    public function changeStatus($id)
    {
        $post = Post::findOrFail($id);
        if ($post->status == 1) {
            $post->update([
                'status' => 0,
            ]);
            Session::flash('success', 'Post Blocked Successfully!');
        } else {
            $post->update([
                'status' => 1,
            ]);
            Session::flash('success', 'Post Actived Successfully!');
        }


        return redirect()->back();
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

    public function deleteComment($comment_id){
        $comment=Comment::findOrFail($comment_id);
        $comment->delete();
        return redirect()->back()->with('success','Comment deleted successfully!!');
    }
}
