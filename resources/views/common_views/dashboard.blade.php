@extends('layouts.dashboard_layout')

@section('custom_style')
    {{-- Start added for user profile photo crop --}}
    <script src="{{ asset('js/user_profile_photo_crop/jquery.min.js') }}"></script>
    <script src="{{ asset('js/user_profile_photo_crop/croppie.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/user_profile_photo_crop/croppie.min.css') }}">
    {{-- END added for user profile photo crop --}}
    <link href="{{ asset('css/admin_dashboard_profile/style.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid px-lg-4">
            {{-------------------Profile Info----------------}}
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-md-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                            <span data-toggle="modal" data-target="#user_profile_photo_modal{{auth()->user()->id}}">
                                                <img src="{{auth()->user()->photo_url != null ? url('storage/'.auth()->user()->photo_url) : asset('/assets/img/null/avatar.jpg')}}" class="rounded-circle img-fluid" width="150" alt="User-Profile-Image">
                                                <i class=" mdi mdi-square-edit-outline feather fas fa-edit m-t-10 f-16 text-dark" data-toggle="tooltip" data-placement="top" title="Upload Photo"></i>
                                            </span>
                                    </div>

                                    <h4 class="font-weight-bold text-white font-times-new-roman">{{auth()->user()->name}}</h4>
                                    <p class="text-dark font-weight-bold">
                                        Dashboard
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Full Name</p>
                                            <h6 class="text-muted f-w-400"><i class="fa fa-user text-green mr-2" aria-hidden="true"></i> {{auth()->user()->name}}</h6>
                                        </div>
                                    </div>
                                    <h6 class="b-b-default"></h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400"><i class="fa fa-envelope text-green mr-2" aria-hidden="true"></i> {{auth()->user()->email}}</h6>
                                        </div>
                                    </div>
                                    <h6 class="b-b-default"></h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400"><i class="fa fa-phone text-green mr-2 font-weight-bold" aria-hidden="true"></i>{{auth()->user()->phone}}</h6>
                                        </div>
                                    </div>
{{--                                    <h6 class="b-b-default"></h6>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <p class="m-b-10 f-w-600">Present Address</p>--}}
{{--                                            <h6 class="text-muted f-w-400"><i class="fa fa-map-marker text-green mr-2" aria-hidden="true" style="font-size: 17px"></i> {{auth()->user()->address}}</h6>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{---------------------------- User Profile Photo Modal ---------------------------}}
    <div class="modal fade" id="user_profile_photo_modal{{auth()->user()->id}}" tabindex="-1" role="dialog" aria-labelledby="create_package_modalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLongTitle">Update Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="owner_id" value="{{auth()->user()->id}}">
                    <div class="form-group row">
                        <label for="profile_photo" class="col-md-4 col-form-label text-md-right mr-3">{{ __('Profile Photo') }}</label>
                        <div class="col-md-6 custom-file">
                            <input type="file" class="custom-file-input" id="upload{{auth()->user()->id}}" name="profile_photo" accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label" for="profile_photo"></label>
                        </div>
                    </div>
                    <center><div id="upload-demo{{auth()->user()->id}}" style="max-width:300px"></div></center>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success" id="upload-result{{auth()->user()->id}}">Upload</button>
                    </div>

                </div>


            </div>
        </div>
    </div>


    <script type="text/javascript">


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $uploadCrop{{auth()->user()->id}} = $('#upload-demo{{auth()->user()->id}}').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle,square
            },
            boundary: {
                width: 280,
                height: 280
            }
        });



        $('#upload{{auth()->user()->id}}').on('change', function () {
            // window.alert('#upload{{auth()->user()->id}}');
            var reader = new FileReader();
            // window.alert(reader{{auth()->user()->id}});
            reader.onload = function (e) {
                $uploadCrop{{auth()->user()->id}}.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('#upload-result{{auth()->user()->id}}').on('click', function (ev) {
            $uploadCrop{{auth()->user()->id}}.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: "/profile_photo_upload",
                    type: "POST",
                    data: {"_token": "{{ csrf_token() }}","image":resp,"user_id":{{auth()->user()->id}} },
                    success: function (data) {
                        location.reload();
                    }
                });
            });
        });


    </script>


@endsection



