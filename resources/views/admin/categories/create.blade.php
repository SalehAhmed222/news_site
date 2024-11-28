@extends('layouts.admin.app')
@section('title')
    Create Users
@endsection
@section('body')

<center>
    <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body shadow mb-2 col-10">
            <h2>Create New User</h2>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Enter User Name" class="form-control">
                        @error('name')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter User UserName" class="form-control">
                        @error('username')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Enter User Email" class="form-control">
                        @error('email')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Enter User phone" class="form-control">
                        @error('phone')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>


                        </select>
                        @error('status')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select name="email_verified_at" class="form-control">
                            <option selected disabled>Email Verified</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>


                        </select>
                        @error('email_verified_at')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="country" placeholder="Enter User Country" class="form-control">
                        @error('country')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="city" placeholder="Enter User City" class="form-control">
                        @error('city')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="street" placeholder="Enter User Street" class="form-control">
                        @error('street')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Enter User Image" class="form-control">
                        @error('image')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="password" placeholder="Enter User Password" class="form-control">
                        @error('password')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="password_confirmation" placeholder="Enter User Password Confirmation" class="form-control">
                        @error('password_confirmation')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>

    </form>
</center>


@endsection
