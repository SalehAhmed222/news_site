<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Posts</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Comments</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latest_posts as $post)
                            <tr>
                                <td>
                                    @can('posts')
                                        <a href="{{ route('admin.posts.show', $post->id) }}">
                                            {{ Illuminate\Support\Str::limit($post->name, 20) }}</a>
                                    @endcan

                                    @cannot('posts')
                                        {{ Illuminate\Support\Str::limit($post->name, 20) }}
                                    @endcannot
                                </td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->comments_count }}</td>
                                <td>{{ $post->status == 1 ? 'Active' : 'Not Active' }}</td>
                            </tr>

                        @empty
                            <p>No Posts</p>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Comments</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Publisher Name</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latest_comments as $comment)
                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>
                                    @can('posts')
                                        <a href="{{ route('admin.posts.show', $comment->post->id) }}">
                                            {{ Illuminate\Support\Str::limit($comment->post->name, 20) }}</a>
                                    @endcan
                                    @cannot('posts')
                                        {{ Illuminate\Support\Str::limit($comment->post->name, 20) }}
                                    @endcannot

                                </td>
                                <td>{{ Illuminate\Support\Str::limit($comment->comment, 30) }}</td>
                                <td>{{ $comment->status == 1 ? 'Active' : 'Not Active' }}</td>
                            </tr>

                        @empty
                            <p>No Posts</p>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>


    </div>



</div>
