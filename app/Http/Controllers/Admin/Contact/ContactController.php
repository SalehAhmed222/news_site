<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:contacts']);
    }
    public function index(){
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;


        $contacts = Contact::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('title', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        });
        $contacts = $contacts->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.contacts.index', compact('contacts'));

    }
    public function show($id){
        $contact=Contact::findOrFail($id);
        $contact->update([
            'status'=>1,
        ]);

        return view('admin.contacts.show',compact('contact'));

    }
    public function destroy($id){
        $contatct=Contact::get();
        $contatct->delete();
        if(!$contatct){
            return redirect()->back()->with('error','Try Again Later!');
        }
        return redirect()->route('admin.contact.index')->with('success','Contact Deleted Successfully!!!');


    }
}
