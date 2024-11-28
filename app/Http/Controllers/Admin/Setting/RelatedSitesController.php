<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\RelatedNewsSites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RelatedSitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:settings');

    }
    public function index()
    {
        $sites=RelatedNewsSites::latest()->paginate(4);

        return view('admin.relatedsites.index',compact('sites'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','min:2','max:20'],
            'url'=>['required','url'],
        ]);
        $site = RelatedNewsSites::create($request->only(['name','url']));
        if (!$site) {
            Session::flash('error', 'Try Again!');
            return redirect()->route('admin.related-sites.index');
        }
        Session::flash('success', 'Site created successfully!');
        return redirect()->route('admin.related-sites.index');
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required','min:2','max:20'],
            'url'=>['required','url'],

        ]);
        $site=RelatedNewsSites::findOrFail($id);
        $site=$site->update($request->only('name','url'));

        if(!$site){
        return redirect()->back()->with('error','Try Again Later!');
        }
        return redirect()->back()->with('success','Site is Updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $site=RelatedNewsSites::findOrFail($id);
        $site->delete();
        return redirect()->back()->with('success','Site is deleted successfully');
    }
}
