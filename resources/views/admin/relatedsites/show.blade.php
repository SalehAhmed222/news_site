@extends('layouts.admin.app')
@section('title')
    Create Users
@endsection
@section('body')

<center>


        <div class="card-body shadow mb-2 col-10">
            <h2>User:{{$user->name}}</h2>
            <br>
            <div class="col-md-4">
                <img src="{{asset($user->image)}}" class="img-thumbnail" alt="Thumbnail image">
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Name:{{$user->name}}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="UserName:{{$user->username}}" class="form-control">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Email:{{$user->email}}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Phone:{{$user->phone}}" class="form-control">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">

                        <input disabled value="Status:{{$user->status==1?'Active':' Not Active'}}" class="form-control">
                        </input>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                            <input  disabled value="Email Status:{{$user->email_verified_at==null?'Not Active':'Active'}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Country:{{$user->country}}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="City:{{$user->city}}" class="form-control">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Street:{{$user->street}}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    {{-- <div class="form-group">
                        <input disabled value="{{$user->name}}" class="form-control">

                    </div> --}}
                </div>
            </div>

            <br>

            <a href="{{route('admin.users.changeStatus',$user->id)}}" class="btn btn-info">{{$user->status==0?'Block':'Active'}}</a>
            <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this user?')){document.getElementById('delete_user').submit()}return false" class="btn btn-danger">Delete</a>


        </div>
        <form id="delete_user" action="{{route('admin.users.destroy',$user->id)}}" method="post">
            @csrf
            @method('DELETE')
        </form>


</center>

@endsection
