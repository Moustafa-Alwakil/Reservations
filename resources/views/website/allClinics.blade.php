@extends('website.layouts.layout')
@section('title')
    {{ __('website\layouts\layout.clinics') }}
@endsection
@section('stylesheets')
    {{-- <!-- Datetimepicker CSS --> --}}
    <link rel="stylesheet" href="{{ url('website/assets/css/bootstrap-datetimepicker.min.css') }}">

    {{-- <!-- Select2 CSS --> --}}
    <link rel="stylesheet" href="{{ url('website/assets/plugins/select2/css/select2.min.css') }}">

    {{-- <!-- Fancybox CSS --> --}}
    <link rel="stylesheet" href="{{ url('website/assets/plugins/fancybox/jquery.fancybox.min.css') }}">
@endsection
@section('content')
    @include('website.includes.bar1')
    {{ __('website\layouts\layout.clinics') }}
    @include('website.includes.bar2')
    @if (isset($_GET['city_id'])||isset($_GET['region_id'])||isset($_GET['male'])||isset($_GET['female'])||isset($_GET['department_id']))
    {{ __('website\allClinics.clinicsearchres') }} ({{count($clinics)}})
    @else
    {{ __('website\allClinics.all') }}
    @endif
    @include('website.includes.bar3')
    @php
    $name = 'name_' . LaravelLocalization::getCurrentLocale();
    $fname = 'fname_' . LaravelLocalization::getCurrentLocale();
    $lname = 'lname_' . LaravelLocalization::getCurrentLocale();
    @endphp
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Search Filter -->
                    <form method="GET" action="{{ route('clinics.filter') }}">
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0"> {{ __('website\allClinics.searchfilter') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="filter-widget">
                                    @if (isset($_GET))
                                        @if (isset($_GET['city_id']))
                                            <input type="hidden" name="city_id" value="{{ $_GET['city_id'] }}">
                                        @endif
                                    @endif
                                    @if (isset($_GET))
                                        @if (isset($_GET['region_id']))
                                            <input type="hidden" name="city_id" value="{{ $_GET['region_id'] }}">
                                        @endif
                                    @endif
                                    <h4> {{ __('website\allClinics.gender') }}</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="male" value="m" @if (isset($_GET['male']) && $_GET['male']){{ 'checked' }}@endif>
                                            <span class="checkmark"></span> {{ __('website\allClinics.male') }}
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="female" value="f" @if (isset($_GET['female']) && $_GET['female']){{ 'checked' }}@endif>
                                            <span class="checkmark"></span> {{ __('website\allClinics.female') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="filter-widget">
                                    <h4> {{ __('website\allClinics.spec') }}</h4>
                                    @foreach ($departments as $department)
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="department_id[]" value="{{ $department->id }}"@if (isset($_GET['department_id']) && in_array($department->id, $_GET['department_id'])){{ 'checked' }}@endif>
                                                <span class="checkmark"></span>
                                                {{ $department->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="btn-search">
                                    <button type="submit" class="btn btn-block">
                                        {{ __('website\allClinics.search') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /Search Filter -->

                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                        @foreach ($clinics as $clinic)
                        
                            <!-- Clinic Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{ route('clinic', ['id' => $clinic->id]) }}">
                                                    <img src="{{ url('images/docphotos/' . $clinic->doctor_photo) }}"
                                                        class="img-fluid" alt="Doctor Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a
                                                        href="{{ route('clinic', ['id' => $clinic->id]) }}">{{ ucwords(json_decode($clinic->name)->$name) }}</a>
                                                </h4>
                                                <p class="doc-speciality">
                                                    Dr.
                                                    {{ ucwords(json_decode($clinic->doctor_name)->$fname . ' ' . json_decode($clinic->doctor_name)->$lname) }}
                                                    - ({{ __('website\layouts\layout.' . $clinic->title) }})
                                                </p>
                                                <h5 class="doc-department">
                                                    {{ ucwords(json_decode($clinic->department_name)->$name) }}
                                                </h5>
                                                <div class="rating">
                                                    @for ($i = 0; $i < $reviewsAvg[$loop->index]; $i++)
                                                        <i class="fas fa-star filled"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $reviewsAvg[$loop->index]; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    <span
                                                        class="d-inline-block average-rating">({{ $reviewsCount[$loop->index] }})</span>
                                                </div>
                                                <div class="clinic-details">
                                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                        {{ ucwords(json_decode($clinic->region_name)->$name) }},
                                                        {{ ucwords(json_decode($clinic->city_name)->$name) }}
                                                    </p>
                                                    <ul class="clinic-gallery">
                                                        @foreach ($clinicPhotos[$loop->index] as $clinicphoto)
                                                            <li>
                                                                <a href="{{ url('images/clinics-photos/' . $clinicphoto->photo) }}"
                                                                    data-fancybox="gallery">
                                                                    <img src="{{ url('images/clinics-photos/' . $clinicphoto->photo) }}"
                                                                        alt="Feature">
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="clinic-services">
                                                    @foreach ($clinicServices[$loop->index] as $service)
                                                        @php
                                                            if (!$service->service) {
                                                                continue;
                                                            }
                                                        @endphp
                                                        <span>{{ ucwords($service->service->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                <ul>
                                                    <li><i class="far fa-thumbs-up"></i>
                                                        @if ($reviewsCount[$loop->index] > 0)
                                                        {{ round(($reviewsSum[$loop->index] / ($reviewsCount[$loop->index] * 5)) * 100) }}%
                                                        @else
                                                        0%
                                                        @endif
                                                    </li>
                                                    <li><i class="far fa-comment"></i>
                                                        {{ $reviewsCount[$loop->index] }}
                                                        Feedback</li>
                                                    <li><i
                                                            class="fas fa-map-marker-alt"></i>{{ ucwords(json_decode($clinic->region_name)->$name) }},
                                                        {{ ucwords(json_decode($clinic->city_name)->$name) }}
                                                    </li>
                                                    <li><i class="fas fa-phone-square-alt"></i> {{ $clinic->phone }}
                                                    </li>
                                                    <li><i class="far fa-money-bill-alt"></i>
                                                        {{ $clinic->price }}
                                                        EGP
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn"
                                                    href="{{ route('clinic', ['id' => $clinic->id]) }}">{{ __('website\allClinics.profile') }}</a>
                                                @if (!Auth::guard('doc')->check() && !Auth::guard('web')->check())
                                                    <a class="apt-btn"
                                                        href="{{ route('user.login') }}">{{ __('website\allClinics.book') }}</a>
                                                @endif
                                                @auth('web')
                                                    <a class="apt-btn"
                                                        href="{{ route('appointment.create', ['id' => $clinic->id]) }}">{{ __('website\allClinics.book') }}</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Clinic Widget -->
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        @isset($clinics)
            {!! $clinics->onEachSide(2)->links() !!}
        @endisset
    </div>
    <!-- /Page Content -->
@endsection
@section('scripts')
    <!-- Select2 JS -->
    <script src="{{ url('website/assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{ url('website/assets/js/moment.min.js') }}"></script>
    <script src="{{ url('website/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Fancybox JS -->
    <script src="{{ url('website/assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

@endsection
