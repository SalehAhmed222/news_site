@extends('layouts.admin.app')

@section('title')
    Contacts
@endsection
@section('body')
    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Contacts Table</h1>
            <p class="mb-4">DataTables is a third party plugin </p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    {{-- <a href="{{route('admin.users.create')}}" style="margin-left: 140ch" class="btn btn-primary">Create User</a> --}}

                    <h6 class="m-0 font-weight-bold text-primary">Contact Management</h6>
                </div>
              @include('admin.contacts.filter.filter')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">title</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">phone</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">title</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">phone</th>
                                    <th style="text-align: center">Created At</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                               @forelse ($contacts as $contact )
                               <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td style="text-align: center">{{$contact->name}}</td>
                                <td style="text-align: center">{{$contact->email}}</td>
                                <td style="text-align: center">{{$contact->title}}</td>

                                <td style="text-align: center; background:@if($contact->status==1)green @else red @endif ; color:white ">{{$contact->status==1?'Read':'UnRead'}}</td>
                                <td style="text-align: center">{{$contact->phone}}</td>
                                <td style="text-align: center">{{$contact->created_at->diffForHumans()}}</td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this contact?')){document.getElementById('delete_contact_{{$contact->id}}').submit()}return false"><i class="fa fa-trash"></i></a>

                                </a>
                                    <a href="{{route('admin.contact.show',[$contact->id,'page'=>request()->page])}}"><i class="fa fa-eye"></i></a>


                                </td>
                            </tr>
                            <form id="delete_contact_{{$contact->id}}" action="{{route('admin.contact.destroy',$contact->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                               @empty
                               <tr>
                                <td class="alert alert-info"style="text-align: center" colspan="6">No Contacts</td>
                               </tr>

                               @endforelse
                            </tbody>
                        </table>
                        {{$contacts->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
