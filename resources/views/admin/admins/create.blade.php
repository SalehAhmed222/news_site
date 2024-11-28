@extends('layouts.admin.app')
@section('title')
    Create Admins
@endsection
@section('body')

<div class="d-flex justify-content-center">
    <form action="{{route('admin.admins.store')}}" method="post" >
        @csrf
        <div class="card-body shadow mb-4" style="min-width: 75ch">

            <div class="row">
                <div class="col-9">

                    <h2>Create New Admin</h2>
                </div>
                <div class="col-3">
                    <a href="{{route('admin.admins.index')}}"   class="btn btn-primary">Back To Admins</a>
                </div>


            </div>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        Enter Name: <input type="text" name="name" placeholder="Enter Admin Name" class="form-control">
                        @error('name')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                       Enter UserName: <input type="text" name="username" placeholder="Enter Admin userName" class="form-control">
                        @error('username')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        Enter Email:<input type="text" name="email" placeholder="Enter Admin Email" class="form-control">
                        @error('email')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        Select Status: <select name="status" class="form-control">
                            <option selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>


                        </select>
                        @error('status')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        Select Roles: <select name="role_id" class="form-control">
                            <option selected disabled>Select Role</option>
                            @forelse ($authorizations as $authorization)
                            <option  value="{{$authorization->id}}">{{$authorization->role}}</option>

                            @empty
                            <option selected disabled>No Roles</option>

                            @endforelse



                        </select>
                        @error('role_id')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        Enter Password:<input type="password" name="password" placeholder="Enter Admin Password" class="form-control">
                        @error('password')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        Enter Password Again:<input type="password" name="password_confirmation" placeholder="Enter Admin Password Confirmation" class="form-control">
                        @error('password_confirmation')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create Admain</button>
        </div>

    </form>
</div>

@endsection
