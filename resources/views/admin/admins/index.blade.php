@extends('layouts.admin.app')

@section('title')
    Admins
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
                    <a href="{{route('admin.admins.create')}}" style="margin-left: 140ch" class="btn btn-primary">Create Admin</a>

                    <h6 class="m-0 font-weight-bold text-primary">Admins Management</h6>
                </div>
              @include('admin.admins.filter.filter')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">UserName</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">Role</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>


                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">UserName</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">Role</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>

                                </tr>
                            </tfoot>
                            <tbody>
                               @forelse ($admins as $admin )
                               <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td style="text-align: center">{{$admin->name}}</td>
                                <td style="text-align: center">{{$admin->username}}</td>
                                <td style="text-align: center">{{$admin->email}}</td>
                                <td style="text-align: center">{{$admin->authorization->role}}</td>
                                <td style="text-align: center; background:@if($admin->status==1)green @else red @endif ; color:white ">{{$admin->status==1?'Active':'Not Active'}}</td>
                                <td style="text-align: center">{{$admin->created_at->format('Y-m-d h:m a')}}</td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this admin?')){document.getElementById('delete_admin_{{$admin->id}}').submit()}return false"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('admin.admins.changeStatus',$admin->id)}}">
                                        @if ($admin->status==1)
                                        <i class="fas fa-user-check"></i>
                                        @else
                                        <i class="fas fa-user-slash"></i>
                                    @endif
                                </a>
                                    <a href="{{route('admin.admins.edit',$admin->id)}}"><i class="fa fa-edit"></i></a>


                                </td>
                            </tr>
                            <form id="delete_admin_{{$admin->id}}" action="{{route('admin.admins.destroy',$admin->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                               @empty
                               <tr>
                                <td class="alert alert-info"style="text-align: center" colspan="6">No Admins</td>
                               </tr>

                               @endforelse
                            </tbody>
                        </table>
                        {{$admins->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
