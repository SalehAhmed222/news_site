@extends('layouts.admin.app')

@section('title')
    Users
@endsection
@section('body')
    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Tables</h1>
            <p class="mb-4">DataTables is a third party plugin </p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{route('admin.users.create')}}" style="margin-left: 140ch" class="btn btn-primary">Create User</a>

                    <h6 class="m-0 font-weight-bold text-primary">Users Management</h6>
                </div>
              @include('admin.users.filter.filter')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Coutry</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Coutry</th>
                                    <th style="text-align: center">Create At</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                               @forelse ($users as $user )
                               <tr>
                                <td style="text-align: center">{{$user->name}}</td>
                                <td style="text-align: center">{{$user->email}}</td>
                                <td style="text-align: center; background:@if($user->status==1)green @else red @endif ; color:white ">{{$user->status==1?'Active':'Not Active'}}</td>
                                <td style="text-align: center">{{$user->country}}</td>
                                <td style="text-align: center">{{$user->created_at->format('Y-m-d h:m a')}}</td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this user?')){document.getElementById('delete_user_{{$user->id}}').submit()}return false"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('admin.users.changeStatus',$user->id)}}">
                                        @if ($user->status==1)
                                        <i class="fas fa-user-check"></i>
                                        @else
                                        <i class="fas fa-user-slash"></i>
                                    @endif
                                </a>
                                    <a href="{{route('admin.users.show',$user->id)}}"><i class="fa fa-eye"></i></a>


                                </td>
                            </tr>
                            <form id="delete_user_{{$user->id}}" action="{{route('admin.users.destroy',$user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                               @empty
                               <tr>
                                <td class="alert alert-info"style="text-align: center" colspan="6">No Usres</td>
                               </tr>

                               @endforelse
                            </tbody>
                        </table>
                        {{$users->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
