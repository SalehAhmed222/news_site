@extends('layouts.admin.app')

@section('title')
   Roles
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
                    <a href="{{route('admin.authorizations.create')}}" style="margin-left: 140ch" class="btn btn-primary">Create Role</a>

                    <h6 class="m-0 font-weight-bold text-primary">Roles Management</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Role Name</th>
                                    <th style="text-align: center">Premessions</th>
                                    <th style="text-align: center">Related Admins</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>


                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Role Name</th>
                                    <th style="text-align: center">Premessions</th>
                                    <th style="text-align: center">Related Admins</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>

                                </tr>
                            </tfoot>
                            <tbody>
                               @forelse ($authorizations as $authorization )
                               <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td style="text-align: center">{{$authorization->role}}</td>
                                <td style="text-align: center">@foreach ($authorization->permessions as $permession )
                                    {{$permession}},

                                @endforeach</td>
                                <th style="text-align: center">{{$authorization->admins->count()}}</th>


                                <td style="text-align: center">{{$authorization->created_at->format('Y-m-d h:m a')}}</td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this admin?')){document.getElementById('delete_admin_{{$authorization->id}}').submit()}return false"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('admin.authorizations.edit',$authorization->id)}}"><i class="fa fa-edit"></i></a>

                                </td>
                            </tr>
                            <form id="delete_admin_{{$authorization->id}}" action="{{route('admin.authorizations.destroy',$authorization->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                               @empty
                               <tr>
                                <td class="alert alert-info"style="text-align: center" colspan="6">No Authorizations</td>
                               </tr>

                               @endforelse
                            </tbody>
                        </table>
                        {{$authorizations->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
