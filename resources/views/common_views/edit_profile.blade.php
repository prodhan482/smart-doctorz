@extends('layouts.dashboard_layout')



@section('content')
    <div class="container-fluid px-lg-4">

        {{-------------------Profile Info----------------}}
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="card card-profile">
                                            <span class="mb-1 text-primary text-center"><i class="icon-people"></i></span>
                                            <h3 class="text-center text-facebook">Edit Profile</h3>
                                        </div>

                                        <div class="div mt-5">
                                            <div class="row justify-content-center">
                                                <div class="col"><h3 class="text-center mt-3 mb-5 text-info">Change Password</h3></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <form action="{{route('update_user_password')}}" method="POST">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old_password">

                                                                @error('old_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new_password">

                                                                @error('new_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="confirm_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="confirm_new_password" type="password" class="form-control" name="confirm_new_password" required autocomplete="new-password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-8 offset-sm-4">
                                                                <button type="submit" class="btn btn-success">Change</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                        </div>




                                        <hr class="border-primary">
                                        <div class="div mt-5">
                                            <div class="row justify-content-center">
                                                <div class="col"><h3 class="text-center mt-3 mb-5 text-info">Change Other Informations</h3></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <form action="{{route('update_user_other_info')}}" method="POST">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name"  value="{{auth()->user()->name}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"  value="{{auth()->user()->email}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" value="{{auth()->user()->phone}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-8 offset-sm-4">
                                                                <button type="submit" class="btn btn-success">Change</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('extra_js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>


    <script src="{{asset('js/dashboard/dashboard-1.js')}}"></script>
@endsection
