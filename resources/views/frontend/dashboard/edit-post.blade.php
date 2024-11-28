@extends('layouts.frontend.app')
@section('title')
    Edit
@endsection

@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar',['profile_active' => 'active'])


        @if (session()->has('errors'))
            <div class="alert alert-danger">
                @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <form method="post" action="{{ route('frontend.dashboard.post.update') }}" enctype="multipart/form-data">
                <!-- Show/Edit Post Section -->
                @csrf
                <section id="posts-section" class="posts-section">
                    <h2>Your Posts</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input name="post_id" type="text" value="{{ $post->id }}" hidden />
                            <input name="name" type="text" class="form-control mb-2 post-title"
                                value="{{ $post->name }}" />
                            {{-- <textarea name="small_desc" id="postTitle" class="form-control mb-2" rows="3" value="{{$post->small_desc?''}}" placeholder="Enter Small Description "></textarea> --}}
                            <textarea name="small_desc" id="postTitle" class="form-control mb-2" rows="3" placeholder="Enter Small Description">{{$post->small_desc ?? ''}}</textarea>



                            <!-- Editable Content -->
                            <textarea name="desc" id="post-desc" class="form-control mb-2 post-content">
                                {!! $post->desc !!}
                  </textarea>

                            {{-- <!-- Post Images Slider -->
                            <div class="tn-slider">
                                <div class="slick-slider edit-slider" id="postImages">
                                    <!-- Existing Images -->
                                </div>
                            </div> --}}

                            <!-- Image Upload Input for Editing -->
                            <input name="images[]" id="post-images" type="file" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">
                                {{-- <option value="general" selected>General</option> --}}

                                @foreach ($categoriesPosts as $category)
                                    <option name="category" value="{{ $category->id }}" @selected($category->id == $post->category_id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach



                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="comment_able" class="form-check-input enable-comments"
                                    @checked($post->comment_able == 1) type="checkbox" />
                                <label name="comment_able" class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye"></i>{{ $post->num_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comments"></i>{{ $post->comments->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">

                                <a href="{{ route('frontend.dashboard.profile') }}"
                                    class="btn btn-danger delete-post-btn">Cancel</a>
                                <button class="btn btn-success save-post-btn ">
                                    Save
                                </button>
                                <button class="btn btn-secondary cancel-edit-btn d-none">
                                    Cancel
                                </button>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script>
        $('#post-images').fileinput({
            maxFileCount: 5,
            allowedFileTypes: ['image'], // allow only images
            theme: 'fa5', //fontawsome icone
            showUpload: false,
            initialPreviewAsData: true,
            initialPreview: [
                @if($post->images->count() > 0)
                    @foreach($post->images as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                @endif
            ],

            //delete image

            initialPreviewConfig:[
                @if($post->images->count() > 0)
                    @foreach($post->images as $image)
                        {
                            caption: "{{$image->path}}",
                            width: "120px",
                            url: "{{route('frontend.dashboard.post.delete-image' ,[$image->id ,'_token'=>csrf_token()])}}", // server delete action
                            key:"{{$image->id}}",

                        },
                    @endforeach
                @endif
            ],

        });


        $('#post-desc').summernote({
            height: 200,
        });
    </script>
@endpush
