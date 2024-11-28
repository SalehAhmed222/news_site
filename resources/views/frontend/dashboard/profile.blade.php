@extends('layouts.frontend.app')
@section('title')
    Profile
@endsection
@section('body')
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar', ['profile_active' => 'active'])


        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ asset(Auth::guard('web')->user()->image) }}" alt="User Image"
                        class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                    <span class="username">{{ Auth::guard('web')->user()->username }}</span>
                </div>
                <br>

                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <!-- Add Post Section -->
                <form action="{{ route('frontend.dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input name="name" type="text" id="postTitle" class="form-control mb-2"
                                placeholder="Post Title" />
                            <textarea name="small_desc" id="postTitle" class="form-control mb-2" rows="3" placeholder="Enter Small Description "></textarea>

                            <!-- Post Content -->
                            <textarea name="desc" id="postContent" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                            <!-- Image Upload -->
                            <input name="images[]" type="file" id="postImage" class="form-control mb-2" accept="image/*"
                                multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select name="category_id" id="postCategory" class="form-select mb-2">
                                <option value="" selected>Select Category</option>
                                @foreach ($categoriesPosts as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <!-- Enable Comments Checkbox -->
                            <label class="form-check-label mb-2">
                                <input name="comment_able" type="checkbox" class="form-check-input" /> Enable Comments
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>

                </form>
                <!--  show all Posts for user Section -->
                @forelse ($posts as $post)
                    <section id="posts" class="posts-section">
                        <h2>Recent Posts</h2>
                        <div class="post-list">
                            <!-- Post Item -->
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="rounded-circle"
                                        style="width: 50px; height: 50px;" />
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                        {{-- <small class="text-muted">2 hours ago</small> --}}
                                    </div>
                                </div>
                                <h4 class="post-title">{{ $post->name }}</h4>
                                <p class="post-content">{!! chunk_split($post->desc, 30) !!}</p>

                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#newsCarousel" data-slide-to="1"></li>
                                        <li data-target="#newsCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($post->images as $image)
                                            <div class="carousel-item  @if ($loop->index == 0) active @endif">
                                                <img src="{{ asset($image->path) }}" class="d-block w-100"
                                                    alt="First Slide">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $post->name }}</h5>

                                                </div>
                                            </div>


                                            <!-- Add more carousel-item blocks for additional slides -->
                                        @endforeach
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

                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                            <i class="fas fa-eye"></i> {{ $post->num_of_views }} views
                                        </span>
                                    </div>

                                    <div>
                                        <a href="{{ route('frontend.dashboard.post.edit', $post->slug) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('are you want to delete this post')){document.getElementById('deleteForm_{{ $post->id }}').submit(); return false}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-thumbs-up"></i> Delete
                                        </a>
                                        <button id="commentbtn_{{ $post->id }}" class="getComments"
                                            post-id={{ $post->id }} class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>
                                        <button id="hidebtnId_{{ $post->id }}" class="hideComments"
                                            style="display: none" post-id={{ $post->id }}
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i>hide Comments
                                        </button>
                                        <form action="{{ route('frontend.dashboard.post.delete') }}" method="post"
                                            id="deleteForm_{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="slug" value="{{ $post->slug }} ">

                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div id="displayComments_{{ $post->id }}" style="display:none" class="comments">

                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>

                            <!-- Add more posts here dynamically -->
                        </div>
                    </section>
                @empty
                    <div class="alert alert-info">no posts!</div>
                @endforelse
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection

@push('js')
    <script>
        $(function() {
            // file input call method
            $('#postImage').fileinput({
                maxFileCount: 5,
                allowedFileTypes: ['image'], // allow only images
                theme: 'fa5', //fontawsome icone
                showUpload: false,

            });

            // summernote call method
            $('#postContent').summernote({
                height: 200,
            });


        });


        //for display get comments
        $(document).on('click', '.getComments', function(e) {
            e.preventDefault();

            var post_id = $(this).attr('post-id')
            $('#displayComments_' + post_id).empty();
            $.ajax({
                type: 'GET',
                url: '{{ route('frontend.dashboard.post.comments', ':post_id') }}'.replace(':post_id',
                    post_id),
                success: function(response) {

                    $.each(response.data, function(indexInArray, comment) {
                        $('#displayComments_' + post_id).append(`
                        <div class="comment">
                                        <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${comment.user.name}</span>
                                            <p class="comment-text">${comment.comment}</p>
                                        </div>
                                    </div>`).show();

                    });


                },

            })
            $('#commentbtn_' + post_id).hide();
            $('#hidebtnId_' + post_id).show();

        })

        //hide comments
        $(document).on('click', '.hideComments', function(e) {
            e.preventDefault();

            var post_id = $(this).attr('post-id')

            //hide comments
            $('#displayComments_' + post_id).hide();
            //hide button hide comments
            $('#hidebtnId_' + post_id).hide();

            //append button getcomments
            $('#commentbtn_' + post_id).show();


        });
    </script>
@endpush
