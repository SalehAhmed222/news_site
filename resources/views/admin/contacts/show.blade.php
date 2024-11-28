@extends('layouts.admin.app')
@section('title')
    Show Contact
@endsection
@section('body')

<center>


        <div class="card-body shadow mb-2 col-10">
            <div class="row">
                <div class="col-6">
                    <h2>Contact:{{$contact->name}}</h2>

                </div>
                <div class="col-6">
                    <a href="{{route('admin.contact.index',['page'=>request()->page])}}"  class="btn btn-primary">Back To Posts</a>

                </div>
            </div>


            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Name:{{$contact->name}}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="title:{{$contact->title}}" class="form-control">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Email:{{$contact->email}}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Phone:{{$contact->phone}}" class="form-control">

                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-6">
                    <div class="form-group">

                        <input disabled value="Status:{{$contact->status==1?'read':' unread'}}" class="form-control">
                        </input>

                    </div>
                </div>

            </div> --}}


            <br>

            {{-- <a href="{{route('admin.users.changeStatus',$contact->id)}}" class="btn btn-info">{{$contact->status==0?'Block':'Active'}}</a> --}}
            <a href="mailto:{{$contact->email}}?subject=Re:{{urlencode($contact->title)}}" class="btn btn-primary">Reply <i class="fas fa-reply"></i></a>

            <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this contact?')){document.getElementById('delete_contact').submit()}return false" class="btn btn-danger">Delete</a>


        </div>
        <form id="delete_contact" action="{{route('admin.contact.destroy',$contact->id)}}" method="post">
            @csrf
            @method('DELETE')
        </form>


</center>

@endsection
