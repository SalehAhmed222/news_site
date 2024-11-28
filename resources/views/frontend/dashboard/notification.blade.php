@extends('layouts.frontend.app')
@section('title')
    Notification
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar',['notify_active' => 'active'])

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                       <h2 class="mb-4">Notifications</h2>

                    </div>
                    <div class="col-6">
                        <a href="{{route('frontend.dashboard.notification.delete-all')}}" style="margin-left: 270px" class="btn btn-sm btn-danger">Delete All</a>

                     </div>

                </div>
              @forelse (auth()->user()->notifications  as $notify )
              <a href="{{route('frontend.post.show', $notify->data['post_slug'] )}}?notify={{$notify->id}}">
                <div class="notification alert alert-info">
                    <strong>you have a comment from:({{$notify->data['user_name']}})</strong>on your post name:({{$notify->data['post_name']}})
                    {{$notify->created_at->diffForHumans()}}
                    <div class="float-right">
                        <button onclick="if(confirm('are your sure delete this notification? ')){document.getElementById('deletenotify').submit()}return false" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                    <form id="deletenotify" action="{{route('frontend.dashboard.notification.delete')}}" method="post">
                       @csrf
                        <input hidden value="{{$notify->id}}" name="notify_id">
                    </form>
                </div>
            </a>
              @empty
              <div class="alert alert-info">Not found notifications.</div>

              @endforelse

            </div>
        </div>
    </div>
    <!-- Dashboard End-->
@endsection
