@extends('layouts.admin.auth.app')
@section('title')
Reset
@endsection
@section('body')
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Enter your new password !</h1>
                            </div>
                            <form class="user" method="post" action="{{route('admin.password.reset')}}">
                                @csrf
                                <div class="form-group">
                                    <input hidden name="email" type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                       value="{{$email}}">
                                </div>
                                @error('email')
                                <div class="text-danger" >{{$message}}</div>

                                @enderror
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                @error('password')
                                <div class="text-danger" >{{$message}}</div>

                                @enderror
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                <div class="text-danger" >{{$message}}</div>

                                @enderror

                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                <hr>

                            </form>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
