@extends('layouts.admin.app')
@section('title')
    Update User
@endsection
@section('body')
   <div class="d-flex justify-content-center">
    <form action="{{ route('admin.posts.update',$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body shadow mb-4" style="min-width:100ch">

            <h2>Update Post</h2>
            <br>

            @if (session()->has('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors')->all() as $error )
                    <li>{{$error}}</li>

                    @endforeach
                </ul>
            </div>

            @endif
            <div class="row">
                <div class="col-12">
                    <div class="form-group">


                        name:<input  type="text" value="{{ old('name',$post->name) }}" name="name" placeholder="Enter Post Name" class="form-control">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        
                            small_desc:<textarea  type="text" name="small_desc" placeholder="Enter  small_desc "
                            class="form-control" >{{ old('small_desc' ,$post->small_desc) }}</textarea>
                        @error('small_desc')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        desc:<textarea id="postContent"  type="text"  name="desc" placeholder="Enter post Description"
                            class="form-control">{!! old('desc' ,$post->desc)!!} </textarea>
                        @error('desc')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        images:<input id="post-images" type="file" multiple name="images[]" placeholder="Enter Post Images"
                            class="form-control">
                        @error('images')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        status:<select name="status" class="form-control">
                            <option value="1" @selected(old('status', $post->status) == 1)>Active</option>
                            <option value="0" @selected(old('status', $post->status) == 0)>Not Active</option>


                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        categories:<select name="category_id"class="form-control">

                            @foreach ($categoriesPosts as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach



                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        comment_able:<select name="comment_able" class="form-control">

                            <option value="1" @selected(old('comment_able', $post->comment_able) == 1)>Active</option>
                            <option value="0" @selected(old('comment_able', $post->comment_able) == 0)>Not Active</option>


                        </select>
                        @error('comment_able')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>



            <br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
        </div>

    </form>
   </div>
@endsection


@push('js')
    <script>
        $(function() {
            // file input call method
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
                            url: "{{route('admin.posts.delete-image' ,[$image->id ,'_token'=>csrf_token()])}}", // server delete action
                            key:"{{$image->id}}",

                        },
                    @endforeach
                @endif
            ],

        });
            // summernote call method
            $('#postContent').summernote({
                height: 200,
            });


        });
    </script>
@endpush
