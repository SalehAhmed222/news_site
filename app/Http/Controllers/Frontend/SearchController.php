<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:200']
        ]);
        $keyword = strip_tags($request->search);//to protect data base from tags  <script>cdsck</script>  this take words in tags just

        $posts = Post::active()->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('desc', 'LIKE', '%' . $keyword . '%')->paginate(9);
        return view('frontend.search', compact('posts'));
    }
}
