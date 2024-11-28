@extends('layouts.admin.app')
@section('title')
    Create Admins
@endsection
@section('body')

<div class="d-flex justify-content-center">
    <form action="{{route('admin.authorizations.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body shadow mb-4" style="min-width: 75ch">

            <div class="row">
                <div class="col-9">

                    <h2>Create New Role</h2>
                </div>
                <div class="col-3">
                    <a href="{{route('admin.authorizations.index')}}"   class="btn btn-primary">Back To Role</a>
                </div>


            </div>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="role" placeholder="Enter Role Name" class="form-control">
                        @error('role')
                        <div class="text-danger">{{$message}}</div>

                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                @foreach (config('authorization.permessions') as $key=>$value )
                <div class="col-4">
                    <div class="form-group">
                       <strong>{{$value}}</strong>  :  <input value="{{$key}}" type='checkbox' name="permessions[]" >
                       @error('permessions')
                       <div class="text-danger">{{$message}}</div>

                       @enderror
                    </div>
                </div>
                @endforeach
            </div>



            <br>
            <button type="submit" class="btn btn-primary">Create Role</button>
        </div>

    </form>
</div>

@endsection
