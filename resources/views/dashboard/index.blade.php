@extends('dashboard.layouts.layout')
@section('title', 'Dashbord')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Welcome {{ ucwords(Auth::guard('admin')->user()->name) }}
    @include('dashboard.includes.pageHeader2')
    @include('dashboard.includes.pageHeader3')

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary border-primary">
                            <i class="fe fe-users"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $doctorsCount }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Doctors</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-warning border-warning">
                            <i class="fas fa-clinic-medical"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $clinicsCount }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Clinics</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $usersCount }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Patients</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-danger border-danger">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $apptsCount }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Approved Appointment</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- Recent Orders -->
            <div class="card card-table">
                <div class="card-header">
                    <h4 class="card-title">Waiting Doctors List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>Personal Photo</th>
                                    <th>Doctor Name (Arabic)</th>
                                    <th>Doctor Name (English)</th>
                                    <th>Speciality (Arabic)</th>
                                    <th>Speciality (English)</th>
                                    <th>License</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($waitingDoctors as $doctor)
                                    @php
                                        if (!$doctor->department_id) {
                                            continue;
                                        }
                                    @endphp
                                    <tr id="doctor{{ $doctor->id }}">
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ $doctor->info->photo }}" class="avatar avatar-sm mr-2"><img
                                                        class="avatar-img rounded-circle" src="{{ $doctor->info->photo }}"
                                                        alt="Doctor Image"></a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a>{{ ucwords($doctor->name['fname_ar'] . ' ' . $doctor->name['lname_ar']) }}</a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a>{{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $doctor->department->name['name_ar'] }}</td>
                                        <td>{{ $doctor->department->name['name_en'] }}</td>
                                        <td><a href="{{ $doctor->info->license }}" target="_blank"><img
                                                    src="{{ $doctor->info->license }}" alt="License" width="20%"
                                                    height="20%"></a></td>
                                        <td>
                                            <a href="{{ $doctor->info->license }}" target="_blank"
                                                class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp;&nbsp;Preview
                                                License</a>
                                            <button id="acceptdoc" doctor_id="{{ $doctor->id }}" type="submit"
                                                class="btn btn-success"><i
                                                    class="fas fa-check-circle"></i>&nbsp;&nbsp;Accept</button>
                                            <button id="refusedoc" doctor_id="{{ $doctor->id }}" type="submit"
                                                class="btn btn-danger"><i
                                                    class="fas fa-times-circle"></i>&nbsp;&nbsp;Refuse</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->
            <br><br><br><br><br><br><br><br>
            <!-- Recent Orders -->
            <div class="card card-table">
                <div class="card-header">
                    <h4 class="card-title">Waiting Clinics List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>Clinic Name (Arabic)</th>
                                    <th>Clinic Name (English)</th>
                                    <th>Doctor Name (Arabic)</th>
                                    <th>Doctor Name (English)</th>
                                    <th>Speciality (Arabic)</th>
                                    <th>Speciality (English)</th>
                                    <th>License</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($waitingClinics as $clinic)
                                    <tr id="clinic{{ $clinic->id }}">
                                        <td>{{ ucwords($clinic->name['name_ar']) }}</td>
                                        <td>{{ ucwords($clinic->name['name_en']) }}</td>
                                        <td>
                                            {{ ucwords($clinic->physican->name['fname_ar'] . ' ' . $doctor->name['lname_ar']) }}
                                        </td>
                                        <td>
                                            {{ ucwords($clinic->physican->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}
                                        </td>
                                        <td>{{ $clinic->physican->department->name['name_ar'] }}</td>
                                        <td>{{ $clinic->physican->department->name['name_en'] }}</td>
                                        <td><a href="{{ $clinic->license }}" target="_blank"><img
                                                    src="{{ $clinic->license }}" alt="License" width="20%"
                                                    height="20%"></a></td>
                                        <td>
                                            <a href="{{ $clinic->license }}" target="_blank" class="btn btn-primary"><i
                                                    class="fas fa-eye"></i>&nbsp;&nbsp;Preview
                                                License</a>
                                            <button id="acceptclinic" clinic_id="{{ $clinic->id }}" type="submit"
                                                class="btn btn-success"><i
                                                    class="fas fa-check-circle"></i>&nbsp;&nbsp;Accept</button>
                                            <button id="refuseclinic" clinic_id="{{ $clinic->id }}" type="submit"
                                                class="btn btn-danger"><i
                                                    class="fas fa-times-circle"></i>&nbsp;&nbsp;Refuse</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '#acceptdoc', function(e) {
            e.preventDefault();
            var id = $(this).attr('doctor_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('doctor.accept') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'status': 1,
                },
                success: function(data) {
                    if (data.status == true) {
                        $('#doctor' + data.id).remove();
                    }
                },
                error: function(reject) {}
            });
        });
    </script>
    <script>
        $(document).on('click', '#refusedoc', function(e) {
            e.preventDefault();
            var id = $(this).attr('doctor_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('doctor.accept') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'status': 0,
                },
                success: function(data) {
                    if (data.status == true) {
                        $('#doctor' + data.id).remove();
                    }
                },
                error: function(reject) {}
            });
        });
    </script>
    <script>
        $(document).on('click', '#acceptclinic', function(e) {
            e.preventDefault();
            var id = $(this).attr('clinic_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('clinic.accept') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'review': 1,
                },
                success: function(data) {
                    if (data.status == true) {
                        $('#clinic' + data.id).remove();
                    }
                },
                error: function(reject) {}
            });
        });
    </script>
    <script>
        $(document).on('click', '#refuseclinic', function(e) {
            e.preventDefault();
            var id = $(this).attr('clinic_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('clinic.accept') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'review': 0,
                },
                success: function(data) {
                    if (data.status == true) {
                        $('#clinic' + data.id).remove();
                    }
                },
                error: function(reject) {}
            });
        });
    </script>
@endsection
