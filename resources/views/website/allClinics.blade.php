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
    @isset($clinics)
        {{ __('website\allClinics.all') }}
    @endisset
    @isset($clinicsByLocation)
        {{ __('website\allClinics.clinicsearch') }}
    @endisset
    {{-- @isset($clinicsByRegion)
        {{ __('website\allClinics.clinicsearch') }}
    @endisset --}}
    @include('website.includes.bar3')
    @php
    $name = 'name_'.LaravelLocalization::getCurrentLocale();
    $fname = 'fname_'.LaravelLocalization::getCurrentLocale();
    $lname = 'lname_'.LaravelLocalization::getCurrentLocale();
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
                                            <input type="checkbox" name="male" value="m">
                                            <span class="checkmark"></span> {{ __('website\allClinics.male') }}
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="female" value="f">
                                            <span class="checkmark"></span> {{ __('website\allClinics.female') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="filter-widget">
                                    <h4> {{ __('website\allClinics.spec') }}</h4>
                                    @foreach ($departments as $department)
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="service_id[]" value="{{ $department->id }}">
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
                    @isset($clinics)
                        @foreach ($clinics as $clinic)
                            <!-- Clinic Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{ route('clinic', ['id' => $clinic->id]) }}">
                                                    <img src="{{ url('images/docphotos/'.$clinic->doctor_photo) }}" class="img-fluid"
                                                        alt="Doctor Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a
                                                        href="{{ route('clinic', ['id' => $clinic->id]) }}">{{ ucwords(json_decode($clinic->name)->$name) }}</a>
                                                </h4>
                                                <p class="doc-speciality">
                                                    Dr.
                                                    {{ ucwords(json_decode($clinic->doctor_name)->$fname . ' ' . json_decode($clinic->doctor_name)->$lname) }} - ({{__('website\layouts\layout.'.$clinic->title)}})
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
                                                                <a href="{{ url('images/clinics-photos/'.$clinicphoto->photo) }}" data-fancybox="gallery">
                                                                    <img src="{{ url('images/clinics-photos/'.$clinicphoto->photo) }}" alt="Feature">
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
                                                        {{ round(($reviewsSum[$loop->index] / ($reviewsCount[$loop->index] * 5)) * 100) }}%
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
                    @endisset
                    @isset($clinicsByLocation)
                    @foreach ($clinicsByLocation as $clinic)
                        @php
                            if (!$clinic->physican || !$clinic->address->region || !$clinic->address->region->city || !$clinic->physican->department) {
                                continue;
                            }
                            $totalReview = 0;
                            foreach ($clinic->physican->reviews as $review) {
                                $totalReview += $review->value;
                            }
                            
                            $avgRate = round(($totalReview * 5) / ($clinic->physican->reviews_count * 5));
                        @endphp
                        <!-- Clinic Widget -->
                        <div class="card">
                            <div class="card-body">
                                <div class="doctor-widget">
                                    <div class="doc-info-left">
                                        <div class="doctor-img">
                                            <a href="{{ route('clinic', ['id' => $clinic->id]) }}">
                                                <img src="{{ $clinic->physican->info->photo }}" class="img-fluid"
                                                    alt="Doctor Image">
                                            </a>
                                        </div>
                                        <div class="doc-info-cont">
                                            <h4 class="doc-name"><a
                                                    href="{{ route('clinic', ['id' => $clinic->id]) }}">{{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</a>
                                            </h4>
                                            <p class="doc-speciality">
                                                Dr.
                                                {{ ucwords($clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }} - ({{__('website\layouts\layout.'.$clinic->physican->info->title)}})
                                            </p>
                                            <h5 class="doc-department">
                                                {{ ucwords($clinic->physican->department->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                            </h5>
                                            <div class="rating">
                                                @for ($i = 0; $i < $avgRate; $i++)
                                                    <i class="fas fa-star filled"></i>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $avgRate; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                                <span
                                                    class="d-inline-block average-rating">({{ $clinic->physican->reviews_count }})</span>
                                            </div>
                                            <div class="clinic-details">
                                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                    {{ ucwords($clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                                    {{ ucwords($clinic->address->region->city->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                </p>
                                                <ul class="clinic-gallery">
                                                    @foreach ($clinic->clinicphotos as $clinicphoto)
                                                        <li>
                                                            <a href="{{ $clinicphoto->photo }}" data-fancybox="gallery">
                                                                <img src="{{ $clinicphoto->photo }}" alt="Feature">
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="clinic-services">
                                                @foreach ($clinic->services as $service)
                                                    @php
                                                        if (!$service) {
                                                            continue;
                                                        }
                                                    @endphp
                                                    <span>{{ ucwords($service->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                <li><i class="far fa-thumbs-up"></i>
                                                    {{ round(($totalReview / ($clinic->physican->reviews_count * 5)) * 100) }}%
                                                </li>
                                                <li><i class="far fa-comment"></i>
                                                    {{ $clinic->physican->reviews_count }}
                                                    Feedback</li>
                                                <li><i
                                                        class="fas fa-map-marker-alt"></i>{{ ucwords($clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                                    {{ ucwords($clinic->address->region->city->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                </li>
                                                <li><i class="fas fa-phone-square-alt"></i> {{ $clinic->phone }}
                                                </li>
                                                <li><i class="far fa-money-bill-alt"></i>
                                                    {{ $clinic->examfee->price }}
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
                @endisset 
                    {{-- @isset($clinicsByCity)
                        @foreach ($clinicsByCity->regions as $region)
                            @php
                                if (!$region) {
                                    continue;
                                }
                            @endphp
                            @if ($region->addresses)
                                @foreach ($region->addresses as $address)
                                    @php
                                        if (!$address->clinic || !$address->clinic->physican || !$address->clinic->physican->department) {
                                            continue;
                                        }
                                        $totalReview = 0;
                                        foreach ($address->clinic->physican->reviews as $review) {
                                            $totalReview += $review->value;
                                        }
                                        
                                        $avgRate = round(($totalReview * 5) / ($address->clinic->physican->reviews_count * 5));
                                    @endphp
                                    <!-- Clinic Widget -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="doctor-widget">
                                                <div class="doc-info-left">
                                                    <div class="doctor-img">
                                                        <a href="{{ route('clinic', ['id' => $address->clinic->id]) }}">
                                                            <img src="{{ $address->clinic->physican->info->photo }}"
                                                                class="img-fluid" alt="Doctor Image">
                                                        </a>
                                                    </div>
                                                    <div class="doc-info-cont">
                                                        <h4 class="doc-name"><a
                                                                href="{{ route('clinic', ['id' => $address->clinic->id]) }}">{{ ucwords($address->clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</a>
                                                        </h4>
                                                        <p class="doc-speciality">
                                                            Dr.
                                                            {{ ucwords($address->clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $address->clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }} - ({{__('website\layouts\layout.'.$address->clinic->physican->info->title)}})
                                                        </p>
                                                        <h5 class="doc-department">
                                                            {{ ucwords($address->clinic->physican->department->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                        </h5>
                                                        <div class="rating">
                                                            @for ($i = 0; $i < $avgRate; $i++)
                                                                <i class="fas fa-star filled"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $avgRate; $i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                            <span
                                                                class="d-inline-block average-rating">({{ $address->clinic->physican->reviews_count }})</span>
                                                        </div>
                                                        <div class="clinic-details">
                                                            <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                                {{ ucwords($region->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                                                {{ ucwords($clinicsByCity->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                            </p>
                                                            <ul class="clinic-gallery">
                                                                @foreach ($address->clinic->clinicphotos as $clinicphoto)
                                                                    <li>
                                                                        <a href="{{ $clinicphoto->photo }}"
                                                                            data-fancybox="gallery">
                                                                            <img src="{{ $clinicphoto->photo }}"
                                                                                alt="Feature">
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="clinic-services">
                                                            @foreach ($address->clinic->services as $service)
                                                                @php
                                                                    if (!$service) {
                                                                        continue;
                                                                    }
                                                                @endphp
                                                                <span>{{ ucwords($service->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="doc-info-right">
                                                    <div class="clini-infos">
                                                        <ul>
                                                            <li><i class="far fa-thumbs-up"></i>
                                                                {{ round(($totalReview / ($address->clinic->physican->reviews_count * 5)) * 100) }}%
                                                            </li>
                                                            <li><i class="far fa-comment"></i>
                                                                {{ $address->clinic->physican->reviews_count }}
                                                                Feedback</li>
                                                            <li><i
                                                                    class="fas fa-map-marker-alt"></i>{{ ucwords($region->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                                                {{ ucwords($clinicsByCity->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                            </li>
                                                            <li><i class="fas fa-phone-square-alt"></i>
                                                                {{ $address->clinic->phone }}
                                                            </li>
                                                            <li><i class="far fa-money-bill-alt"></i>
                                                                {{ $address->clinic->examfee->price }}
                                                                EGP
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="clinic-booking">
                                                        <a class="view-pro-btn"
                                                            href="{{ route('clinic', ['id' => $address->clinic->id]) }}">{{ __('website\allClinics.profile') }}</a>
                                                        @if (!Auth::guard('doc')->check() && !Auth::guard('web')->check())
                                                            <a class="apt-btn"
                                                                href="{{ route('user.login') }}">{{ __('website\allClinics.book') }}</a>
                                                        @endif
                                                        @auth('web')
                                                            <a class="apt-btn"
                                                                href="{{ route('appointment.create', ['id' => $address->clinic->id]) }}">{{ __('website\allClinics.book') }}</a>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Clinic Widget -->
                                @endforeach
                            @endif
                        @endforeach
                    @endisset
                    {{-- @isset($clinicsByRegion)
                        @if ($clinicsByRegion->addresses)
                            @foreach ($clinicsByRegion->addresses as $address)
                                @php
                                    if (!$address->clinic || !$address->clinic->physican || !$address->clinic->physican->department) {
                                        continue;
                                    }
                                    $totalReview = 0;
                                    foreach ($address->clinic->physican->reviews as $review) {
                                        $totalReview += $review->value;
                                    }
                                    
                                    $avgRate = round(($totalReview * 5) / ($address->clinic->physican->reviews_count * 5));
                                @endphp
                                <!-- Clinic Widget -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="doctor-widget">
                                            <div class="doc-info-left">
                                                <div class="doctor-img">
                                                    <a href="{{ route('clinic', ['id' => $address->clinic->id]) }}">
                                                        <img src="{{ $address->clinic->physican->info->photo }}"
                                                            class="img-fluid" alt="Doctor Image">
                                                    </a>
                                                </div>
                                                <div class="doc-info-cont">
                                                    <h4 class="doc-name"><a
                                                            href="{{ route('clinic', ['id' => $address->clinic->id]) }}">{{ ucwords($address->clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</a>
                                                    </h4>
                                                    <p class="doc-speciality">
                                                        Dr.
                                                        {{ ucwords($address->clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $address->clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }}
                                                    </p>
                                                    <h5 class="doc-department">
                                                        {{ ucwords($address->clinic->physican->department->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                    </h5>
                                                    <div class="rating">
                                                        @for ($i = 0; $i < $avgRate; $i++)
                                                            <i class="fas fa-star filled"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $avgRate; $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                        <span
                                                            class="d-inline-block average-rating">({{ $address->clinic->physican->reviews_count }})</span>
                                                    </div>
                                                    <div class="clinic-details">
                                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                            {{ ucwords($clinicsByRegion->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                                            {{ ucwords($clinicsByRegion->city->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                        </p>
                                                        <ul class="clinic-gallery">
                                                            @foreach ($address->clinic->clinicphotos as $clinicphoto)
                                                                <li>
                                                                    <a href="{{ $clinicphoto->photo }}"
                                                                        data-fancybox="gallery">
                                                                        <img src="{{ $clinicphoto->photo }}" alt="Feature">
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="clinic-services">
                                                        @foreach ($address->clinic->services as $service)
                                                            @php
                                                                if (!$service) {
                                                                    continue;
                                                                }
                                                            @endphp
                                                            <span>{{ ucwords($service->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="doc-info-right">
                                                <div class="clini-infos">
                                                    <ul>
                                                        <li><i class="far fa-thumbs-up"></i>
                                                            {{ round(($totalReview / ($address->clinic->physican->reviews_count * 5)) * 100) }}%
                                                        </li>
                                                        <li><i class="far fa-comment"></i>
                                                            {{ $address->clinic->physican->reviews_count }}
                                                            Feedback</li>
                                                        <li><i
                                                                class="fas fa-map-marker-alt"></i>{{ ucwords($clinicsByRegion->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                                            {{ ucwords($clinicsByRegion->city->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                        </li>
                                                        <li><i class="fas fa-phone-square-alt"></i> {{ $address->clinic->phone }}
                                                        </li>
                                                        <li><i class="far fa-money-bill-alt"></i>
                                                            {{ $address->clinic->examfee->price }}
                                                            EGP
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clinic-booking">
                                                    <a class="view-pro-btn"
                                                        href="{{ route('clinic', ['id' => $address->clinic->id]) }}">{{__('website\allClinics.profile')}}</a>
                                                    @if (!Auth::guard('doc')->check() && !Auth::guard('web')->check())
                                                        <a class="apt-btn" href="{{ route('user.login') }}">{{__('website\allClinics.book')}}</a>
                                                    @endif
                                                    @auth('web')
                                                        <a class="apt-btn"
                                                            href="{{ route('appointment.create', ['id' => $address->clinic->id]) }}">{{__('website\allClinics.book')}}</a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Widget -->
                            @endforeach
                        @endif
                    @endisset --}}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        @isset($clinics)
            {!! $clinics->links() !!}
        @endisset
        @isset($clinicsByLocation)
            {!! $clinicsByLocation->links() !!}
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
