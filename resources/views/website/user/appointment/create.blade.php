@extends('website.layouts.layout')
@section('title')
    Clinics
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ url('assets/css/style1.css') }}">
    <link rel="stylesheet" href="{{ url('website/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ url('website/assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('content')
    @include('website.includes.bar1')
    {{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
    @include('website.includes.bar2')
    Booking Appointment
    @include('website.includes.bar3')
    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            @php
                $totalReview = 0;
                foreach ($clinic->physican->reviews as $review) {
                    $totalReview += $review->value;
                }
                
                $avgRate = round(($totalReview * 5) / ($clinic->physican->reviews_count * 5));
            @endphp
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="doctor-profile.html" class="booking-doc-img">
                                    <img src="{{ $clinic->physican->info->photo }}" alt="Doctor Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a
                                            href="doctor-profile.html">{{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</a>
                                    </h4>
                                    <p class="doc-speciality">Dr.
                                        {{ ucwords($clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }}
                                    </p>
                                    <div class="rating">
                                        @for ($i = 0; $i < $avgRate; $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        @for ($i = 0; $i < 5 - $avgRate; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        <span
                                            class="d-inline-block average-rating">{{ $clinic->physican->reviews_count }}</span>
                                    </div>
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>
                                        {{ ucwords($clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                        {{ ucwords($clinic->address->region->city->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        $appoinment_date=[];
                                        $appoinment_start=[];
                                        foreach ($clinic->appointments as $appointment){
                                            if(!$appointment->status == 3){
                                                $appoinment_date[$a] = $appointment->date;
                                                $appoinment_start[$a] = $appointment->start_time;
                                                $a++;
                                            }
                                            }
                                        $b= 1;
                                        $exception_date = [];
                                        $exception_start = [];
                                            foreach ($clinic->exceptions as $exception){
                                            $exception_date[$b] = $exception->date;
                                            $exception_start[$b] = $exception->start_time;
                                            $b++;
                                            }
                                            $begin_date = new DateTime(date('Y-m-d H:i'));
                                            $end = new DateTime(date('Y-m-d')); 
                                            $end_date = $end->modify('+3 month');
                                            for ($i = $begin_date; $i <= $end_date; $i->modify('+1 day')) {
                                                $day = $i->format('Y-m-d');
                                                if ($clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_status'] == 1) {
                                                    $start_time = new DateTime(date($day . ' ' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_start_time']));
                                                    $end_time = new DateTime(date($day . ' ' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_end_time']));
                                                    for($start_time;$start_time->format('Y-m-d H:i')<=date('Y-m-d H:i');$start_time->modify('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute')){
                                                    }
                                                    for ($x = $start_time; $x <= $end_time; $x->modify('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute')) {
                                                        
                                                        ?>
                                        @if (( array_search($day,$appoinment_date) &&
                                        array_search($x->format('H:i'),$appoinment_start) ) || (
                                        array_search($day,$exception_date) &&
                                        array_search($x->format('H:i'),$exception_start) ))
                                        <tr class="bg-secondary">
                                            <td>{{ $x->format('Y-m-d') }}</td>
                                            <td>{{ date('l', strtotime($x->format('Y-m-d'))) }}
                                            </td>
                                            <td>{{ $x->format('h:i A') }}</td>
                                            <td>{{ date('h:i A', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}
                                            </td>
                                            <td class="text-lg text-warning">Already Booked</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $x->format('Y-m-d') }}</td>
                                            <td>{{ date('l', strtotime($x->format('Y-m-d'))) }}
                                            </td>
                                            <td>{{ $x->format('h:i A') }}</td>
                                            <td>{{ date('h:i A', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('appointment.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="date" value="{{ $x->format('Y-m-d') }}">
                                                    <input type="hidden" name="bookdate" value="{{ date('j M Y') }}">
                                                    <input type="hidden" name="start_time"
                                                        value="{{ $x->format('H:i') }}">
                                                    <input type="hidden" name="end_time"
                                                        value="{{ date('H:i', strtotime('+' . $clinic->workday->available[lcfirst(date('l', strtotime($day)))][lcfirst(date('D', strtotime($day))) . '_duration'] . ' minute', strtotime($x->format('H:i')))) }}">
                                                    <input type="hidden" name="clinic_id" value="{{ $clinic->id }}">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fas fa-bookmark"></i> Book This Appointment</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
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
@endsection
