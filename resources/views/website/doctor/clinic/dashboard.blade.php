@extends('website.layouts.layout')
@section('title')
    {{-- get the name of the user from the session --}}
    @php
    $name = Auth::guard('doc')->user()->name;
    @endphp
    {{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
    {{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }} - Dashboard
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ url('assets/css/style1.css') }}">
    <link rel="stylesheet" href="{{ url('website/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ url('website/assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('content')
    @include('website.includes.bar1')
    Clinics
    @include('website.includes.bar2')
    {{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }} Dashboard
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('website.includes.sidebar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card dash-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar1">
                                                    <div class="circle-graph1" data-percent="75">
                                                        <img src="{{ url('website/assets/img/icon-01.png') }}"
                                                            class="img-fluid" alt="patient">
                                                    </div>
                                                </div>
                                                @php
                                                    $l = 0;
                                                    $h = 0;
                                                    $patients = [];
                                                    foreach ($clinic->appointments as $appointment) {
                                                        if ($appointment->status == 1 && $appointment->date == date('Y-m-d')) {
                                                            $l++;
                                                        }
                                                    }
                                                    foreach ($clinic->appointments as $appointment) {
                                                        $patients[$h] = $appointment->user_id;
                                                    }
                                                    
                                                @endphp
                                                <div class="dash-widget-info">
                                                    <h6>Total Patient</h6>
                                                    <h3>{{ count(array_unique($patients)) }}</h3>
                                                    <p class="text-muted">Till Today</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <img src="{{ url('website/assets/img/icon-02.png') }}"
                                                            class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Today Appointments</h6>
                                                    <h3>{{ $l }}</h3>
                                                    <p class="text-muted">Today</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="50">
                                                        <img src="{{ url('website/assets/img/icon-03.png') }}"
                                                            class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Appoinments</h6>
                                                    <h3>{{ $clinic->appointments_count }}</h3>
                                                    <p class="text-muted">Till Today</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body pt-0">

                            <!-- Tab Menu -->
                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments"
                                            data-toggle="tab">Appointments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#schedule" data-toggle="tab">Today Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#schedule_exceptions" data-toggle="tab"><span
                                                class="med-records">Schedule Exceptions</span></a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /Tab Menu -->

                            <!-- Tab Content -->
                            <div class="tab-content pt-0">

                                <!-- Upcoming Appointment Tab -->
                                <div class="tab-pane fade show active" id="pat_appointments">

                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Patient Name</th>
                                                            <th>Appt Date</th>
                                                            <th>Appt Time</th>
                                                            <th>Book Date</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($clinic->appointments as $appointment)
                                                            @if ($appointment->status == 0 && $appointment->datetime > date('Y-m-d H:i'))
                                                                <tr id="apptRow{{ $appointment->id }}">
                                                                    <td>
                                                                        <a>{{ ucwords($appointment->user->name['fname']) . ' ' . ucwords($appointment->user->name['lname']) }}</a>
                                                                        </h2>
                                                                    </td>
                                                                    <td>{{ date_format(date_create($appointment->date), 'j M Y') }}
                                                                    </td>
                                                                    <td>{{ date_format(date_create($appointment->start_time), 'h:i A') }}
                                                                    </td>
                                                                    <td>{{ $appointment->bookdate }}</td>
                                                                    <td>{{ $clinic->examfee->price }} EGP</td>
                                                                    <td>
                                                                        <div class="table-action">
                                                                            <form id="ApptFormUpdate" method="POST"
                                                                                action="" class="d-inline">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $appointment->id }}">
                                                                                <input type="hidden" name="status"
                                                                                    value="1">
                                                                                <button id="update" type="submit"
                                                                                    class="btn btn-sm bg-success-light">
                                                                                    <i class="fas fa-check"></i> Accept
                                                                                </button>
                                                                            </form>
                                                                            <form id="ApptFormUpdate" method="POST"
                                                                                action="" class="d-inline">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $appointment->id }}">
                                                                                <input type="hidden" name="status"
                                                                                    value="2">
                                                                                <button id="update" type="submit"
                                                                                    class="btn btn-sm bg-danger-light">
                                                                                    <i class="fas fa-times"></i> Refuse
                                                                                </button>
                                                                                <form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Upcoming Appointment Tab -->

                                <!-- Schedule Tab -->
                                <div class="tab-pane fade" id="schedule">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Patient Name</th>
                                                            <th>Date</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($clinic->appointments as $appointment)
                                                            @if ($appointment->status == 1 && $appointment->datetime > date('Y-m-d H:i'))
                                                                <tr>
                                                                    <td>{{ ucwords($appointment->user->name['fname']) . ' ' . ucwords($appointment->user->name['lname']) }}
                                                                    </td>
                                                                    <td>{{ date_format(date_create($appointment->date), 'j M Y') }}
                                                                    </td>
                                                                    <td>{{ date_format(date_create($appointment->start_time), 'h:i A') }}
                                                                    </td>
                                                                    <td>
                                                                        {{ date_format(date_create($appointment->end_time), 'h:i A') }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Schedule Tab -->

                                <!-- Exceptions Tab -->
                                <div id="schedule_exceptions" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="datatable table table-stripped text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Day</th>
                                                                    <th>Start Time</th>
                                                                    <th>End Time</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $a = 1;
                                                                $appoinment_datetime=[];
                                                                foreach ($clinic->appointments as $appointment){
                                                                    if(!$appointment->status == 0 || $appointment->status == 1){
                                                                        $appoinment_datetime[$a] = $appointment->datetime;
                                                                        $a++;
                                                                    }
                                                                 }
                                                                    $begin_date = new DateTime(date('Y-m-d H:i'));
                                                                    $end = new DateTime(date('Y-m-d')); 
                                                                    $end_date = $end->modify('+5 month');
                                                                    for ($i = $begin_date; $i <= $end_date; $i->modify('+1 day')) {
                                                                        $day = $i->format('Y-m-d');
                                                                        if ($clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_status'] == 1) {
                                                                            $start_time = new DateTime(date($day . ' ' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_start_time']));
                                                                            $end_time = new DateTime(date($day . ' ' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_end_time']));
                                                                            for($start_time;$start_time->format('Y-m-d H:i')<=date('Y-m-d H:i');$start_time->modify('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute')){
                                                                            }
                                                                            for ($x = $start_time; $x <= $end_time; $x->modify('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute')) {
                                                                                if ( array_search($x->format('Y-m-d H:i'),$appoinment_datetime) ){
                                                                                    continue;
                                                                                }
                                                                                ?>
                                                                <tr>
                                                                    <td>{{ $x->format('Y-m-d') }}</td>
                                                                    <td>{{ date('l', strtotime($x->format('Y-m-d'))) }}
                                                                    </td>
                                                                    <td>{{ $x->format('h:i A') }}</td>
                                                                    <td>{{ date('h:i A', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            class="busy-span{{ $x->format('H:i') }}{{ $x->format('Y-m-d') }}"><span
                                                                                class="busy{{ $x->format('H:i') }}{{ $x->format('Y-m-d') }}"><a
                                                                                    href=""
                                                                                    class="busy-btn btn btn-outline-danger btn-rounded"
                                                                                    date="{{ $x->format('Y-m-d') }}"
                                                                                    start_time="{{ $x->format('H:i') }}"
                                                                                    end_time="{{ date('H:i ', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}"><i
                                                                                        class="far fa-bell-slash"></i>
                                                                                    Busy</a></span></span>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Exceptions Tab -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- Slimscroll JS -->
        <script src="{{ url('website/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Datatables JS -->
        <script src="{{ url('website/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('website/assets/plugins/datatables/datatables.min.js') }}"></script>
        <script src="{{ url('website/assets/js/script1.js') }}"></script>

        <!-- Circle Progress JS -->
        <script src="{{ url('website/assets/js/circle-progress.min.js') }}"></script>

        <script type='text/javascript'>
            $(document).ready(function() {
                $(document).on('click', '.busy-btn', function(e) {
                        e.preventDefault();
                        var date = $(this).attr('date');
                        var start_time = $(this).attr('start_time');
                        var end_time = $(this).attr('end_time');
                        $.ajax({
                                type: 'post',
                                url: "{{ route('exception.store') }}",
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                    'date': date,
                                    'start_time': start_time,
                                    'end_time': end_time,
                                },
                                success: function(data) {
                                    var button = "<span class='busy" + data.start_time data.date +
                                        "'><a href='' class = 'busy-btn btn btn-danger btn-rounded' date = '" +
                                        data.date + "' start_time = '" + data.start_time +
                                        "' end_time = '" + data.end_time +
                                        "' > < iclass = 'far fa-bell-slash' > < /i>Busy < /a></span > ";

                                    $('.busy' + data.start_time data.date).remove();
                                    $('.busy-span' + data.start_time data.date).append(button);
                                },
                                error: function(reject) {},
                            }
                        });
                });
            });
        </script>
        <script>
            $(document).on('click', '#update', function(e) {
                e.preventDefault();
                var formData = new FormData($('#ApptFormUpdate')[0]);
                $.ajax({
                    type: 'post',
                    url: "{{ route('doctor.appointment.update') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            $('#apptRow' + data.id).remove();
                        }
                    },
                    error: function(reject) {}
                });
            });
        </script>
    @endsection
