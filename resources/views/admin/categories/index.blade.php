@extends('layouts.admin.app')

@section('title')
    Categories
@endsection
@section('body')
    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Tables</h1>
            <p class="mb-4">DataTables is a third party plugin .</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categories Managment</h6>
                </div>
                @include('admin.categories.filter.filter')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Post Count</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Post Count</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <th style="text-align: center">{{ $loop->iteration }}</th>

                                        <td style="text-align: center">{{ $category->name }}</td>

                                        <td
                                            style="text-align: center; background:@if ($category->status == 1) green @else red @endif ; color:white ">
                                            {{ $category->status == 1 ? 'Active' : 'Not Active' }}</td>
                                        <td style="text-align: center">{{ $category->posts->count() }}</td>
                                        <td style="text-align: center">{{ $category->created_at->format('Y-m-d h:m a') }}</td>
                                        <td style="text-align: center">
                                            <a href="javascript:void(0)"
                                                onclick="if(confirm('do you want to delete this category?')){document.getElementById('delete_category_{{ $category->id }}').submit()}return false"><i
                                                    class="fa fa-trash"></i></a>
                                            <a href="{{ route('admin.categories.changeStatus', $category->id) }}">
                                                @if ($category->status == 1)
                                                    <i class="fas fa-user-check"></i>
                                                @else
                                                    <i class="fas fa-user-slash"></i>
                                                @endif
                                            </a>

                                            <a href="javascript:void(0)">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#update-category-{{$category->id}}"></i>

                                            </a>





                                        </td>
                                    </tr>
                                    <form id="delete_category_{{ $category->id }}"
                                        action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                   @include('admin.categories.edit')
                                @empty
                                    <tr>
                                        <td class="alert alert-info" style="text-align: center" colspan="6">No Categories
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {{ $categories->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- start Modal create category -->
    <form method="post" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input name="name" class="form-control" placeholder="Enter Category Nmae">
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option disabled selected>Category Status</option>
                                <option value="1">Actice</option>
                                <option value="0">Not Active</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end Modal create category -->
@endsection
