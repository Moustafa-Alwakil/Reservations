@extends('website.layouts.layout')
@section('title')
    {{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
@endsection
@section('stylesheets')
    {{-- <!-- Fancybox CSS --> --}}
    <link rel="stylesheet" href="{{ url('website/assets/plugins/fancybox/jquery.fancybox.min.css') }}">
@endsection
@section('content')
    @include('website.includes.bar1')
    {{__('website\layouts\layout.clinics')}}
    @include('website.includes.bar2')
    {{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }} {{__('website\clinic.profile')}}
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
                if($clinic->physican->reviews_count > 0){
                    $avgRate = round(($totalReview * 5) / ($clinic->physican->reviews_count * 5));
                }else{
                    $avgRate = 0;
                }
            @endphp
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ $clinic->physican->info->photo }}" class="img-fluid" alt="Doctor Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">
                                    {{ ucwords($clinic->name['name_' . LaravelLocalization::getCurrentLocale()]) }}</h4>
                                <p class="doc-speciality">Dr.
                                    {{ ucwords($clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }} - ({{__('website\layouts\layout.'.$clinic->physican->info->title)}})
                                </p>
                                <p class="doc-department">
                                    {{ ucwords($clinic->physican->department->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                </p>
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
                                        if(!$service)
                                        continue;
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
                                        @if($clinic->physican->reviews_count > 0)
                                        {{ round(($totalReview / ($clinic->physican->reviews_count * 5)) * 100) }}%
                                        @else
                                        0%
                                        @endif
                                    </li>
                                    <li><i class="far fa-comment"></i> {{ $clinic->physican->reviews_count }} Feedback
                                    </li>
                                    <li><i
                                            class="fas fa-map-marker-alt"></i>{{ ucwords($clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()]) }},
                                        {{ ucwords($clinic->address->region->city->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                    </li>
                                    <li><i class="fas fa-phone-square-alt"></i> {{ $clinic->phone }}
                                    </li>
                                    <li><i class="far fa-money-bill-alt"></i> {{ $clinic->examfee->price }} EGP
                                    </li>
                                </ul>
                            </div>
                            <div class="clinic-booking">
                                @if (!Auth::guard('doc')->check() && !Auth::guard('web')->check())
                                    <a class="apt-btn" href="{{ route('user.login') }}">{{__('website\allClinics.book')}}</a>
                                @endif
                                @auth('web')
                                    <a class="apt-btn" href="{{ route('appointment.create', ['id' => $clinic->id]) }}">{{__('website\allClinics.book')}}</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body pt-0">

                    <!-- Tab Menu -->
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-toggle="tab">{{__('website\clinic.overview')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-toggle="tab">{{__('website\clinic.reviews')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_business_hours" data-toggle="tab">{{__('website\clinic.bushour')}}</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /Tab Menu -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-0">

                        <!-- Overview Content -->
                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <!-- About Details -->
                                    <div class="widget about-widget">
                                        <h4 class="widget-title">{{__('website\clinic.about')}}</h4>
                                        <p>{{ $clinic->physican->info->about['about_' . LaravelLocalization::getCurrentLocale()] }}
                                        </p>
                                    </div>
                                    <!-- /About Details -->

                                    	<!-- Education Details -->
										<div class="widget education-widget">
											<h4 class="widget-title">Education</h4>
											<div class="experience-box">
												<ul class="experience-list">
                                                    @foreach($clinic->physican->certificates as $certificate)
                                                    <li>
														<div class="experience-user">
															<div class="before-circle"></div>
														</div>
														<div class="experience-content">
															<div class="timeline-content">
																<a href="#/" class="name">{{$certificate->field['field_'. LaravelLocalization::getCurrentLocale()]}} - {{$certificate->university['university_'. LaravelLocalization::getCurrentLocale()]}}</a>
																<div>{{ $certificate->type }}</div>
																<span class="time">{{date_format(date_create($certificate->start_date),'j M Y')}} - {{date_format(date_create($certificate->end_date),'j M Y')}}</span>
															</div>
														</div>
													</li>
                                                    @endforeach
												</ul>
											</div>
										</div>
										<!-- /Education Details -->

                                    <!-- Experience Details -->
                                    <div class="widget experience-widget">
                                        <h4 class="widget-title">{{__('website\clinic.ex')}}</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach ($clinic->physican->experiences as $experience)
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#/" class="name">{{ $experience->title['title_' . LaravelLocalization::getCurrentLocale()] }}
                                                                    -
                                                                    {{ $experience->place['place_' . LaravelLocalization::getCurrentLocale()] }}</a>
                                                                <span
                                                                    class="time">{{ date_format(date_create($experience->start_date), 'Y') }}
                                                                    - @if ($experience->end_date)
                                                                        {{ date_format(date_create($experience->end_date), 'Y') }}
                                                                    @else
                                                                    {{__('website\clinic.present')}}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Experience Details -->

                                    <!-- Services List -->
                                    <div class="service-list">
                                        <h4>{{__('website\clinic.services')}}</h4>
                                        <ul class="clearfix">
                                            @foreach ($clinic->services as $service)
                                            @php
                                            if(!$service)
                                            continue;
                                        @endphp
                                                <li>{{ ucwords($service->name['name_' . LaravelLocalization::getCurrentLocale()]) }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Services List -->

                                    <!-- Loction -->
                                    <div class="service-list">
                                        <h4>{{__('website\clinic.address')}}</h4><br>
                                        <ul class="clearfix">
                                            <p><i class="fas fa-map-marker-alt"></i>
                                                {{ $clinic->address->street['street_' . LaravelLocalization::getCurrentLocale()] }}
                                                , building:
                                                {{ $clinic->address->building['building_' . LaravelLocalization::getCurrentLocale()] }}
                                                , floor: {{ $clinic->address->floor }}
                                                , Apartment: {{ $clinic->address->apartno }}
                                                (
                                                {{ $clinic->address->region->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                                ,
                                                {{ $clinic->address->region->city->name['name_' . LaravelLocalization::getCurrentLocale()] }})
                                            <br><br><i class="fas fa-map-marked-alt"></i> {{__('website\clinic.landmark')}}: {{ $clinic->address->landmark['landmark_' . LaravelLocalization::getCurrentLocale()] }}</p>
                                        </ul>
                                    </div>
                                    <!-- /Loction -->

                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->

                        <!-- Reviews Content -->
                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <!-- Review Listing -->
                            <div class="widget review-listing">
                                <ul class="comments-list">
                                    @include('website.includes.sessionDisplay')
                                    @forelse ($clinic->physican->reviews as $review)
                                        <!-- Comment List -->
                                        <li>
                                            <div class="comment">
                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span
                                                            class="comment-author">{{ $review->name['fname'] . ' ' . $review->name['lname'] }}</span>
                                                        <span
                                                            class="comment-date">{{ date_format(date_create($review->created_at), 'j M Y h:i A') }}</span>
                                                    </div>
                                                    <p class="recommended">{{ $review->title }}</p>
                                                    <p class="comment-content">
                                                        {{ $review->comment }}
                                                    </p>
                                                    <div class="review-count rating">
                                                        @for ($i = 0; $i < $review->value; $i++)
                                                            <i class="fas fa-star filled"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $review->value; $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                        @if (Auth::guard('web')->check())
                                                            @if ($review->user_id == Auth::guard('web')->user()->id)
                                                                <br><br>
                                                                <form method="POST"
                                                                    action="{{ route('review.destroy') }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ $review->user_id }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $review->id }}">
                                                                    <button class="btn btn-sm btn-danger">{{__('website\clinic.del')}}</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <!-- /Comment List -->
                                        @empty
                                        <h4 class="text-center">{{__('website\clinic.reviewmsg3')}} 
                                        </h4>
                                        @endforelse

                                </ul>
                            </div>
                            <!-- /Review Listing -->
                            @if (Auth::guard('web')->check())
                                <!-- Write Review -->
                                <div class="write-review">
                                    <h4>{{__('website\clinic.writerev')}} <strong>{{__('website\clinic.dr')}} 
                                            {{ ucwords($clinic->physican->name['fname_' . LaravelLocalization::getCurrentLocale()] . ' ' . $clinic->physican->name['lname_' . LaravelLocalization::getCurrentLocale()]) }}</strong>
                                    </h4>

                                    <!-- Write Review Form -->
                                    <form method="POST" action="{{ route('review.store') }}">
                                        @csrf
                                        <input type="text" name="physican_id" hidden value="{{ $clinic->physican->id }}">
                                        <div class="form-group">
                                            <label>{{__('website\clinic.review')}} </label>
                                            <div class="star-rating">
                                                <input id="star-5" type="radio" name="value" value="5">
                                                <label for="star-5" title="5 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-4" type="radio" name="value" value="4">
                                                <label for="star-4" title="4 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-3" type="radio" name="value" value="3">
                                                <label for="star-3" title="3 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-2" type="radio" name="value" value="2">
                                                <label for="star-2" title="2 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-1" type="radio" name="value" value="1">
                                                <label for="star-1" title="1 star">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                            </div>
                                            @error('value')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('website\clinic.reviewtitle')}} </label>
                                            <input class="form-control" type="text"
                                                placeholder="If you could say it in one sentence, what would you say?"
                                                name="title" value="{{ old('title') }}">
                                        </div>
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>{{__('website\clinic.yourreview')}} </label>
                                            <textarea id="review_desc" maxlength="100" class="form-control"
                                                name="comment">{{ old('comment') }}</textarea>

                                            <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span
                                                        id="chars">100</span> {{__('website\clinic.100char')}} </small></div>
                                        </div>
                                        @error('comment')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <hr>
                                        <div class="form-group">
                                            <div class="terms-accept">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="terms_accept" name="accept" value="1">
                                                    <label for="terms_accept">{{__('website\clinic.read')}} <a href="{{route('terms')}}">{{__('website\clinic.terms')}} </a></label>
                                                </div>
                                            </div>
                                            @error('accept')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">{{__('website\clinic.addreview')}}</button>
                                        </div>
                                    </form>
                                    <!-- /Write Review Form -->

                                </div>
                                <!-- /Write Review -->
                            @elseif(Auth::guard('doc')->check()||Auth::guard('admin')->check())
                            <div class="write-review">
                                <h4>{{__('website\clinic.reviewmsg2')}} 
                                </h4>
                            </div>
                            @else
                                <div class="write-review">
                                    <h4>{{__('website\clinic.reviewmsg1')}} <a
                                            href="{{ route('user.login') }}" class="text-primary">{{__('website\clinic.click')}}</a>
                                    </h4>
                                </div>
                            @endif

                        </div>
                        <!-- /Reviews Content -->

                        <!-- Business Hours Content -->
                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">

                                    <!-- Business Hours Widget -->
                                    <div class="widget business-widget">
                                        <div class="widget-content">
                                            <div class="listing-hours">
                                                <div class="listing-day current">
                                                    <div class="day">{{__('website\clinic.today')}} <span>{{ date('j M Y') }}</span></div>
                                                    <div class="time-items">
                                                        <span class="open-status">
                                                            @if ($clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')) . '_status'] == 1 && $clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')) . '_end_time'] > date('H:i'))
                                                                <span class="badge bg-success-light">{{__('website\clinic.open')}}</span>
                                                        </span>
                                                        <span
                                                            class="time">{{ date_format(date_create($clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')) . '_start_time']), 'h:i A') }}
                                                            -
                                                            {{ date_format(date_create($clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')) . '_end_time']), 'h:i A') }}</span>
                                                    @elseif($clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')).'_status']==
                                                        0)
                                                        <span class="badge bg-danger-light">{{__('website\clinic.closed')}}</span></span>
                                                    @else
                                                        <span class="badge bg-danger-light">{{__('website\clinic.closed')}}</span></span>
                                                        <span
                                                            class="time">{{ date_format(date_create($clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')) . '_start_time']), 'h:i A') }}
                                                            -
                                                            {{ date_format(date_create($clinic->workday->available[lcfirst(date('l'))][lcfirst(date('D')) . '_end_time']), 'h:i A') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <?php
                                                                    $begin = new DateTime(date('Y-m-d'));
                                                                    $end = new DateTime(date('Y-m-d')); 
                                                                    $begin_date = $begin->modify('+1 day');
                                                                    $end_date = $end->modify('+6 day');
                                                                    for ($i = $begin_date; $i <= $end_date; $i->modify('+1 day')) {
                                                                        $day = $i->format('Y-m-d');
                                                                        ?>
                                                                        @if($clinic->workday->available[lcfirst(date_format(date_create($day),'l'))][lcfirst(date_format(date_create($day),'D')) . '_status'] == 0)
                                                                        <div class="listing-day closed">
                                                                            <div class="day">{{__('website\clinic.'.date_format(date_create($day),'l'))}}</div>
                                                                            <div class="time-items">
                                                                                <span class="time"><span
                                                                                        class="badge bg-danger-light">{{__('website\clinic.closed')}}</span></span>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        <div class="listing-day closed">
                                                                            <div class="day">{{__('website\clinic.'.date_format(date_create($day),'l'))}}</div>
                                                                            <div class="time-items">
                                                                                <span class="time">{{date_format(date_create($clinic->workday->available[lcfirst(date_format(date_create($day),'l'))][lcfirst(date_format(date_create($day),'D')) . '_start_time']),'h:i A')}} - {{date_format(date_create($clinic->workday->available[lcfirst(date_format(date_create($day),'l'))][lcfirst(date_format(date_create($day),'D')) . '_end_time']),'h:i A')}}</span>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                <?php
                                                                    }
                                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Business Hours Widget -->

                                </div>
                            </div>
                        </div>
                        <!-- /Business Hours Content -->

                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->

        </div>
    </div>
    <!-- /Page Content -->
@endsection
@section('scripts')
    <!-- Fancybox JS -->
    <script src="{{ url('website/assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endsection
