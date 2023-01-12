@extends('layouts.dashboard_layout')
@section('custom_style')
    <link href="{{asset('/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="col-md-12 mt-lg-4 mt-4">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h2 mb-0 text-gray-800 text-info font-weight-bold">User Managements</h1>
                                <a href="{{ route('manage_users.create') }}" class="d-none d-sm-inline-block btn-sm btn-primary shadow-sm"><i class="fa fa-list"></i>
                                    Create New User
                                </a>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                </div>
            </div>
        {{----------------------------------Table Starts-------------------------------------------}}

        <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card py-3">
                    <div class="table-responsive">
                        <table class="table table-striped zero-configuration">
                            <thead>
                            <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                <th>#</th>
                                <th>Service</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach ($service->descendants as $item)
                            <tr>
                                <td>{{ $loop -> index + 1}}</td>
                                <td>
                                    <a href="{{route('services.show',$item->id)}}">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-sm btn-warning" href="{{ route('services.edit',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <span data-toggle="tooltip" data-placement="top" title="Delete"><button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#delete_warning_modal" data-item_id="{{$item->id}}"><i class="fa fa-trash"></i></button></span>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{--------------------------Delete Warning Modal------------------------------}}
    <div class="modal fade" id="delete_warning_modal" tabindex="-1" role="dialog" aria-labelledby="delete_warning_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <form action="{{route('services.destroy', 2)}}" method="POST" id="delete_warning_form">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" id="user_id_d" value="">
                        <div class="text-center my-3">
                            <img src="{{asset('/images/warning.png')}}" alt="" style="height: 100px; width: 100px">
                        </div>
                        <div class="text-center display-5 font-weight-bold">
                            Are You Sure ?
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra_js')
    <script src="{{asset('/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
@endsection
