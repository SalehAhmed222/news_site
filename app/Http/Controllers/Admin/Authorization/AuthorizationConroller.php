<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorizationRequest;
use App\Models\Authorization;
use Illuminate\Http\Request;

class AuthorizationConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    //this function for protects permessions from admin write routes to open pages

    public function __construct()
    {
        $this->middleware('can:authorizations');

    }
    public function index()
    {
        $authorizations = Authorization::paginate(5);
        if (!$authorizations) {
            return redirect()->back()->with('error', 'Try again later!');
        }
        return view('admin.authorizations.index', compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authorizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
        //i write this way old because permession is json in model
        $authorization = new Authorization();
        $authorization->role = $request->role;
        $authorization->permessions = json_encode($request->permessions);
        $authorization->save();



        return redirect()->back()->with('success', 'Role Created Successfully!');
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
        $authorization=Authorization::findOrFail($id);

        return view('admin.authorizations.edit',compact('authorization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authorization=Authorization::findOrFail($id);
        $authorization->role = $request->role;
        $authorization->permessions = json_encode($request->permessions);
        $authorization->save();
        return redirect()->route('admin.authorizations.index')->with('success','Role Updated Successfully!!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $authorization = Authorization::findOrFail($id);
        if($authorization->admins->count()>0){
            return redirect()->back()->with('error', 'please delete related admin first');

        }

        $authorization->delete();
        if (! $authorization) {
            return redirect()->back()->with('error', 'Try Again');
        }
        return redirect()->back()->with('success', 'Role deleted successfully!');
    }
}
