@extends('layouts.admin.app')

@section('title')
    R-Sites
@endsection
@section('body')
    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Related Sites</h1>
            <p class="mb-4">DataTables is a third party plugin .</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">sites Managment</h6>
                </div>
                <div class="card-header py-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
                        Create Site
                     </button>
                </div>


{{--
                <div class="col-2">
                    <div class="form-group">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
                           Create Category
                        </button>
                    </div>
                </div> --}}

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Url</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center"> Action</th>



                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Url</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center"> Action</th>



                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($sites as $site)
                                    <tr>
                                        <th style="text-align: center">{{ $loop->iteration }}</th>

                                        <td style="text-align: center">{{ $site->name }}</td>
                                        <td style="text-align: center">{{ $site->url }}</td>


                                        <td style="text-align: center">{{ $site->created_at->format('Y-m-d h:m a') }}</td>
                                        <td style="text-align: center">
                                            <a href="javascript:void(0)"
                                                onclick="if(confirm('do you want to delete this site?')){document.getElementById('delete_site_{{ $site->id }}').submit()}return false"><i
                                                    class="fa fa-trash"></i></a>

                                            <a href="javascript:void(0)">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#update-site-{{$site->id}}"></i>

                                            </a>





                                        </td>
                                    </tr>
                                    <form id="delete_site_{{ $site->id }}"
                                        action="{{ route('admin.related-sites.destroy', $site->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                   @include('admin.relatedsites.edit')
                                @empty
                                    <tr>
                                        <td class="alert alert-info" style="text-align: center" colspan="6">No Sites Found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {{$sites->appends(request()->input())->links()}}

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- start Modal create site -->
    <form method="post" action="{{ route('admin.related-sites.store') }}">
        @csrf

        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Related Site</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input name="name" class="form-control" placeholder="Enter Site Name">
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="url" class="form-control" placeholder="Enter Site Url">
                            @error('staurltus')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Site</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end Modal create site -->
@endsection
