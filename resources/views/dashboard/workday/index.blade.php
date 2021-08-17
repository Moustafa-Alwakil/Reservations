@extends('dashboard.layouts.layout')
@section('title', 'All Workdays')
@section('content')
@include('dashboard.includes.pageHeader1')
Workdays
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Workdays</li>
<li class="breadcrumb-item">All Workdays</li>
@include('dashboard.includes.pageHeader3')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                @include('website.includes.sessionDisplay')
                <div class="table-responsive">
                    <table class="datatable table table-stripped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Clinic (Arabic)</th>
                                <th>Clinic (English)</th>
                                <th>Doctor (Arabic)</th>
                                <th>Doctor (English)</th>
                                <th>Saturday</th>
                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workdays as $workday)
                                <tr>
                                    <td>{{ $workday->id }}</td>
                                    <td>{{ $workday->clinic->name['name_ar'] }}</td>
                                    <td>{{ $workday->clinic->name['name_en'] }}</td>
                                    <td>{{ ucwords($workday->clinic->physican->name['fname_ar'] . ' ' . $workday->clinic->physican->name['lname_ar']) }}
                                    </td>
                                    <td>{{ ucwords($workday->clinic->physican->name['fname_en'] . ' ' . $workday->clinic->physican->name['lname_en']) }}
                                    </td>
                                    <td>Status: @if ($workday->available['saturday']['sat_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['saturday']['sat_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['saturday']['sat_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['saturday']['sat_duration'] }} Minutes
                                        @elseif($workday->available['saturday']['sat_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>Status: @if ($workday->available['sunday']['sun_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['sunday']['sun_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['sunday']['sun_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['sunday']['sun_duration'] }} Minutes
                                        @elseif($workday->available['sunday']['sun_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>Status: @if ($workday->available['monday']['mon_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['monday']['mon_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['monday']['mon_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['monday']['mon_duration'] }} Minutes
                                        @elseif($workday->available['monday']['mon_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>Status: @if ($workday->available['tuesday']['tue_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['tuesday']['tue_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['tuesday']['tue_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['tuesday']['tue_duration'] }} Minutes
                                        @elseif($workday->available['tuesday']['tue_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>Status: @if ($workday->available['wednesday']['wed_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['wednesday']['wed_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['wednesday']['wed_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['wednesday']['wed_duration'] }} Minutes
                                        @elseif($workday->available['wednesday']['wed_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>Status: @if ($workday->available['thursday']['thu_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['thursday']['thu_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['thursday']['thu_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['thursday']['thu_duration'] }} Minutes
                                        @elseif($workday->available['thursday']['thu_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>Status: @if ($workday->available['friday']['fri_status'] == 1)
                                            {{ 'Available this day' }}<br>
                                            From:
                                            {{ date_format(date_create($workday->available['friday']['fri_start_time']), 'h:i A') }}<br>
                                            To:
                                            {{ date_format(date_create($workday->available['friday']['fri_end_time']), 'h:i A') }}<br>
                                            Examination Duration:
                                            {{ $workday->available['friday']['fri_duration'] }} Minutes
                                        @elseif($workday->available['friday']['fri_status'] == 0)
                                            {{ 'Not available this day' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('workdays.edit', ['workday' => $workday->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST" class="d-inline"
                                            action="{{ route('workdays.destroy', ['workday' => $workday->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
