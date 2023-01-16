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
                                <h1 class="h2 mb-0 text-gray-800 text-info font-weight-bold">Add New Doctor</h1>
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
                    <form method="post" action="{{ route('manage_doctor_store') }}">
                        @csrf
                        <input type="hidden" class="form-control" id="role" name="role" value="DOCTOR" required>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Doctor Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Doctor Name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone No.<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="+880 1XXX NNNNNN" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender<span class="text-danger">*</span></label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option selected value="" disabled>SELECT</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="nonbinary">Nonbinary</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Chamber Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="chamber_name" name="chamber_name"
                                    placeholder="Enter Chamber Name" required>
                            </div>


                            <div class="form-group">
                                <label for="name">Category<span class="text-danger">*</span></label>
                                <select class="form-control" name="category" id="category" required>
                                    <option selected value="" disabled>SELECT</option>
                                    <option value="Dentist">Dentist</option>
                                    <option value="Allergists">Allergists</option>
                                    <option value="Dermatologists">Dermatologists</option>
                                    <option value="Ophthalmologists">Ophthalmologists</option>
                                    <option value="Cardiologists">Cardiologists</option>
                                    <option value="Gastroenterologists">Gastroenterologists</option>
                                    <option value="Urologists">Urologists</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Education<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="education" name="education"
                                    placeholder="Enter Education" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Experience<span class="text-danger">*</span></label>
                                <input type="textarea" class="form-control" id="experience" name="experience"
                                    placeholder="Enter your Experience" required>
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
