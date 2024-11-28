<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;

use Livewire\Component;

class LatestPostComment extends Component
{
    public function render()
    {



        $latest_posts=Post::withCount('comments')->latest()->take(6)->get();
        $latest_comments=Comment::with(['user','post'])->latest()->take(6)->get();




        return view('livewire.admin.latest-post-comment',compact('latest_posts','latest_comments'));
    }
}
