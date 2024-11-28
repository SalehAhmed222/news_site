@extends('layouts.admin.app')

@section('title')
    Posts
@endsection
@section('body')
    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Posts</h1>
            <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                For more information about DataTables</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{route('admin.posts.create')}}" style="margin-left: 140ch" class="btn btn-primary">Create Posts</a>

                    <h6 class="m-0 font-weight-bold text-primary">Posts Management </h6>
                </div>
              @include('admin.posts.filter.filter')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Category</th>
                                    <th style="text-align: center">User</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">views</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Category</th>
                                    <th style="text-align: center">User</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">views</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                               @forelse ($posts as $post )
                               <tr>
                                <th style="text-align: center">{{$loop->iteration}}</th>

                                <td style="text-align: center">{{$post->name}}</td>
                                <td style="text-align: center">
                                    {{ $post->category ? $post->category->name : 'No Category' }}
                                </td>


                                <td style="text-align: center">{{$post->user->name??$post->admin->name}}</td>
                                <td style="text-align: center; background:@if($post->status==1)green @else red @endif ; color:white ">{{$post->status==1?'Active':'Not Active'}}</td>
                                <td style="text-align: center">{{$post->num_of_views}}</td>

                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this post?')){document.getElementById('delete_post_{{$post->id}}').submit()}return false"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('admin.posts.changeStatus',$post->id)}}">
                                        @if ($post->status==1)
                                        <i class="fas fa-user-check"></i>
                                        @else
                                        <i class="fas fa-user-slash"></i>
                                    @endif
                                </a>
                                    <a href="{{route('admin.posts.show',[$post->id,'page'=>request()->page])}}"><i class="fa fa-eye"></i></a>
                                    @if($post->user_id ==null)
                                        <a href="{{route('admin.posts.edit',$post->id)}}"><i class="fa fa-edit"></i></a>

                                    @endif



                                </td>
                            </tr>
                            <form id="delete_post_{{$post->id}}" action="{{route('admin.posts.destroy',$post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                               @empty
                               <tr>
                                <td class="alert alert-info"style="text-align: center" colspan="6">No Posts</td>
                               </tr>

                               @endforelse
                            </tbody>
                        </table>
                        {{$posts->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
