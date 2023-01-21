@extends('layouts.dashboard_layout')
@section('custom_style')
@endsection

@section('page_errors')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                                <h1 class="h2 mb-0 text-gray-800 text-info font-weight-bold">Add New Patient</h1>
                                <a href="{{ route('dashboard') }}" class="d-sm-inline-block btn-sm btn-danger shadow-sm"><i
                                        class="fa fa-backward mr-2"></i>
                                    Dashboard
                                </a>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                </div>
            </div>

            <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card card-body">
                    <form method="post" action="{{ route('manage_patient_store') }}">
                        @csrf
                        <input type="hidden" class="form-control" id="role" name="role" value="PATIENT">


                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Patient Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Patient Name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone No.<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="+880 1XXX 0X00X0" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Email<span class="text-danger"></span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@mail.com">
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender<span class="text-danger">*</span></label><br>
                                <input type="radio" name="gender" value="male"> Male
                                <input type="radio" name="gender" value="female"> Female
                                <input type="radio" name="gender" value="other"> Other
                            </div>

                            <div class="form-group">
                                <label for="name">Blood Group<span class="text-danger">*</span></label>
                                <select class="form-control" id="blood_group" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+VE">A+VE</option>
                                    <option value="A-VE">A-VE</option>
                                    <option value="B+VE">B+VE</option>
                                    <option value="B-VE">B-VE</option>
                                    <option value="O+VE">O+VE</option>
                                    <option value="O-VE">O-VE</option>
                                    <option value="AB+VE">AB+VE</option>
                                    <option value="AB-VE">AB-VE</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="name">Date of Birth<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    placeholder="Enter your Birthdate" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password <span class="text-danger font-weight-bold">*</span></label>
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="password" placeholder="Enter Password">
                            </div>




                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('extra_js')
@endsection
