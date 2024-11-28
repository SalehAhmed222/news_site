@extends('layouts.frontend.app')
@section('title')
    show|{{ $mainPost->name }}
@endsection

@section('meta_desc')
    {{ $mainPost->small_desc }}
@endsection
{{-- canonical tage to optimize seo --}}
@push('header')
<link rel="canonical" href="{{url()->full()}}"/>

@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $mainPost->name }}</li>
@endsection
@section('body')
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainPost->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide" style="width: 400px;height:400px"/>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $mainPost->name }}</h5>
                                        <p>{!! substr($mainPost->desc, 0, 70) !!}</p>
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
                    <div class="alert alert-info">Publiser:{{ $mainPost->user->name  ?? $mainPost->admin->name }}</div>
                    <div class="sn-content">
                        {!! $mainPost->desc !!}
                    </div>


                    <!-- Comment Section -->
                    @auth
                       @if (auth('web')->user()->status !=0)
                       @if ($mainPost->comment_able == true)
                       <div class="comment-section">
                           <!-- Comment Input -->
                           <form id="commentForm">
                               <div class="comment-input">
                                   @csrf
                                   <input id="commentInput" type="text" name="comment"placeholder="Add a comment..." />
                                   <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                   <input type="hidden" name="post_id" value="{{ $mainPost->id }}">

                                   <button type="submit">Add Comment</button>
                               </div>

                           </form>
                           <div style="display: none" id="errorMsg" class="alert alert-danger">
                               {{-- dispaly error message --}}
                           </div>
                           <!-- Display Comments -->
                           <div class="comments">
                               @foreach ($mainPost->comments as $comment)
                                   <div class="comment">
                                       <img src="{{ asset($comment->user->image) }}" alt="User Image"
                                           class="comment-img" />
                                       <div class="comment-content">
                                           <span class="username">{{ $comment->user->name }}</span>
                                           <p class="comment-text">{{ $comment->comment }}</p>
                                       </div>
                                   </div>
                               @endforeach

                               <!-- Add more comments here for demonstration -->
                           </div>


                           <!-- Show More Button -->
                           @if ($mainPost->comments->count() >= 2)
                               <button id="showMoreBtn" class="show-more-btn">Show more</button>
                           @endif
                       </div>
                   @else
                       <div class="alert alert-info">Comment Not Active</div>
                   @endif

                       @endif
                    @endauth
                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($posts_belongs_to_category as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ asset($post->images->first()->path) }}" class="img-fluid"
                                            alt="{{ $post->name }}"  style="width: 260px;height:200px"//>
                                        <div class="sn-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }} "
                                                title="{{ $post->name }}">{{ $post->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($posts_belongs_to_category as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ asset($post->images->first()->path) }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>



                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#featured">Latest</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                    </li>

                                </ul>
                                {{-- section latest_posts --}}
                                <div class="tab-content">
                                    <div id="featured" class="container tab-pane active">
                                        @foreach ($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title='{{ $post->name }}'>{{ $post->name }}</a>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach ($greatest_posts_comment as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title='{{ $post->name }}'>{{ $post->name }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categoriesPosts as $category)
                                        <li><a
                                                href="">{{ $category->name }}</a><span>({{ $category->posts->count() }})</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        {{-- <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image" /></a>
                            </div>
                        </div> --}}

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection


{{-- jquery for use ajax --}}
@push('js')
    <script>
        //show more comments
        $(document).on('click', '#showMoreBtn', function(e) {
            e.preventDefault();

            //ajax
            $.ajax({
                url: "{{ route('frontend.post.getAllComments', $mainPost->slug) }}",
                type: "GET",
                success: function(data) {
                    $('.comments').empty();
                    $.each(data, function(key, comment) {
                        $('.comments').append(`
                         <div class="comment">
                            <img src="{{ asset('') }}${comment.user.image}" alt="User Image" class="comment-img" />
                            <div class="comment-content">
                                <span class="username">${comment.user.name}</span>
                                <p class="comment-text">${comment.comment}</p>
                            </div>
                        </div>

                    `);
                        $('#showMoreBtn').hide();
                    });

                },
                error: function(data) {


                }
            });
        })


        //add new comment
        $(document).on('submit', '#commentForm', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]); //for come data from  Form
            $('#commentInput').val(''); //for hide text after add comment

            $.ajax({
                url: "{{ route('frontend.post.addNewComment') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#errorMsg').hide();
                    $('.comments').prepend(`
                    <div class="comment">
                         <img src="{{ asset('') }}${data.comment.user.image}" alt="User Image" class="comment-img" />
                        <div class="comment-content">
                         <span class="username">${ data.comment.user.name }</span>
                        <p class="comment-text">${ data.comment.comment }</p>
                                    </div>
                                </div>

                    `);



                },
                error: function(data) {
                    var response = $.parseJSON(data.responseText);
                    $('#errorMsg').text(response.errors.comment).show();

                }

            });
        })
    </script>
@endpush
