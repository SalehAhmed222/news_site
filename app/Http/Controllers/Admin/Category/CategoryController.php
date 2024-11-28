<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

       //this function for protects permessions from admin write routes to open pages
    public function __construct()
    {
        $this->middleware('can:categories');

    }
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;


        $categories = Category::withCount('posts')->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        });
        $categories = $categories->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();
        $category = Category::create($request->except(['_token']));
        if (!$category) {
            Session::flash('error', 'Try Again!');
            return redirect()->route('admin.categories.index');
        }
        Session::flash('success', 'Category created successfully!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $request->validated();
        $category = Category::findOrFail($id);
        $category = $category->update($request->except('_token'));
        if (!$category) {
            Session::flash('error', 'Try again Later!');
            return redirect()->route('admin.categories.index');
        }
        Session::flash('success', 'Category updated successfully!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Category::findOrFail($id);

        $user->delete();
        Session::flash('success', 'Category deleted successfully!');
        return redirect()->route('admin.categories.index');
    }

    public function changeStatus($id)
    {
        $user = Category::findOrFail($id);
        if ($user->status == 1) {
            $user->update([
                'status' => 0
            ]);
            Session::flash('success', 'Category Blocked Successfully!');
        } else {
            $user->update([
                'status' => 1
            ]);
            Session::flash('success', 'Category Actived Successfully!');
        }

        return redirect()->back();
    }
}
