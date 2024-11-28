@extends('layouts.admin.app')
@section('title')
    Notifications
@endsection
@section('body')
    <div class="d-flex justify-content-center">
        <div class="card-body shadow mb-4" style="max-width:100ch;">

            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>

                    </div>
                     <div class="col-6" >
                        <a style="margin-left: 33ch" href="{{route('admin.notification.deleteAll')}}"class="btn btn-danger btn-sm">Delete All</a>


                    </div>


                </div>
                @forelse ($notifications  as $notify )

                  <div class="notification alert alert-info">
                      <strong> <a href="{{$notify->data['link']}}?notify_admin={{$notify->id}}" style="text-decoration: none">{{$notify->data['user_name']}}</strong></a>  :  {{$notify->data['contact_title']}}
                      <br>
                     <strong style="color: red"> {{$notify->created_at->diffForHumans()}}</strong>
                      <div class="float-right">

                          <a href="{{route('admin.notification.destroy',$notify->id)}}"class="btn btn-danger btn-sm">Delete</a>
                      </div>
                    </div>


                @empty
                <div class="alert alert-info">Not found notifications.</div>

                @endforelse

            </div>


        </div>
    </div>
@endsection
