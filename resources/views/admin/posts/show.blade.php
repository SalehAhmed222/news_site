@extends('layouts.admin.app')
@section('title')
    Show Post
@endsection
@section('body')
    <div class="d-flex justify-content-center">


        <div class="card-body shadow mb-4" style="max-width:100ch;">
            <a href="{{ route('admin.posts.index', ['page' => request()->page]) }}" class="btn btn-primary">Back To Posts</a>
            <br>
            <!-- Carousel -->
            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                </ol>
                <br>
                <div class="carousel-inner">
                    @foreach ($post->images as $image)
                        <div class="carousel-item @if ($loop->index == 0) active @endif">
                            <img src="{{ asset($image->path) }}" class="d-block w-100"
                                style="object-fit: cover; height: 450px;" alt="First Slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $post->name }}</h5>
                                <p>{!! substr($post->desc, 0, 70) !!}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Add more carousel-item blocks for additional slides -->
                </div>
                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-user"> : {{ $post->user->name ?? $post->admin->name }}</i>
                </div>
                <div class="col-4">
                    <i class="fa fa-eye"> : {{ $post->num_of_views }}</i>
                </div>
                <div class="col-4">
                    <i class="fa fa-calendar-alt"> : {{ $post->created_at->format('Y-m-d h:m a') }}</i>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-comment"> :<span
                            style="text-align: center; background:@if ($post->comment_able == 1) green @else red @endif ; color:white ">{{ $post->comment_able == 1 ? 'Active' : 'Not Active' }}</span>
                    </i>
                </div>
                <div class="col-4">
                    <i class="fa fa-check-circle"> :<span
                            style="text-align: center; background:@if ($post->status == 1) green @else red @endif ; color:white ">{{ $post->status == 1 ? 'Active' : 'Not Active' }}</span>
                    </i>

                </div>
                <div class="col-4">
                    <i class="fa fa-folder"> : {{ $post->category->name }}</i>
                </div>

            </div>
            <br>

            <div class="sn-content">
                <strong> {{ $post->small_desc }}</strong>
            </div>
            <br>
            <div class="sn-content">
                {!! $post->desc !!}
            </div>
            <br>
            <center>

                <a href="javascript:void(0)"
                    onclick="if(confirm('do you want to delete this post?')){document.getElementById('delete_post').submit()}return false"
                    class="btn btn-danger">Delete</a>
                <a href="{{ route('admin.posts.changeStatus', $post->id) }}"
                    class="btn btn-primary">{{ $post->status == 0 ? 'Block' : 'Active' }}</a>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-info">Edit</a>



            </center>
        </div>

    </div>
    <form id="delete_post" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')

    </form>

    <div class="d-flex justify-content-center">
        <div class="card-body shadow mb-4" style="max-width:100ch;">

            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Comments</h2>

                    </div>


                </div>
                @forelse ($post->comments as $comment)
                    <div class="notification alert alert-info">
                        <img src="{{ asset($comment->user->image) }}" alt="user-comment-image"
                            style="  width: 50px;height: 50px; border-radius: 50%; object-fit: cover;">
                        <a href="{{ route('admin.users.show', $comment->user->id) }}" style="text-decoration: none"><strong>
                                : {{ $comment->user->name }}</strong></a> {{ $comment->comment }}

                        <strong style="color: red"> {{ $comment->created_at->diffForHumans() }}</strong>
                        <div class="float-right">
                            <a href="{{ route('admin.posts.deletecomment', $comment->id) }}"
                                class="btn btn-danger btn-sm">Delete</a>
                        </div>


                    </div>

                    @empty
                    <div class="alert alert-info">Not found comments.</div>
                    @endforelse

                </div>


        </div>
    </div>
@endsection


