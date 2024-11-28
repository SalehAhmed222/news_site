@extends('layouts.admin.app')
@section('title')
    Update profile
@endsection
@section('body')


    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.profile.update') }}" method="post" >
            @csrf
            <div class="card-body shadow mb-4 " style="min-width:100ch">
                <h2>Update Profile</h2>
                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">

                            name:<input value="{{auth('admin')->user()->name}}"  type="text" name="name" placeholder="Enter admin  name"
                                class="form-control">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            username:<input value="{{auth('admin')->user()->username}}"  type="text" name="username" placeholder="Enter admin username" class="form-control">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            email:<input value="{{auth('admin')->user()->email}}"  type="text" name="email" placeholder="Enter admin email" class="form-control">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            password:<input   type="password" name="password" placeholder="Enter admin Confirm Password"
                                class="form-control">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>





                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>

            </div>

        </form>
    </div>
@endsection


