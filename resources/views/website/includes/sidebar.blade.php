                <!-- Profile Sidebar -->
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        @php
                            use App\Models\Info;
                        @endphp
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <div class="profile-det-info">
                                    @if (Auth::guard('web')->check())
                                        <h3>{{ $name['fname'] . ' ' . $name['lname'] }}</h3>
                                    @elseif(Auth::guard('doc')->check())
                                        @if (Auth::guard('doc')->user()->info)
                                            <a href="{{ route('doctor.profile') }}" class="booking-doc-img">
                                                <img src="{{ Auth::guard('doc')->user()->info->photo }}" alt="Profile Picture">
                                            </a>
                                        @endif
                                        <h3>{{ ucwords($name['fname_' . LaravelLocalization::getCurrentLocale() . ''] . ' ' . $name['lname_' . LaravelLocalization::getCurrentLocale() . '']) }}
                                        </h3>
                                    @endif
                                    <div class="patient-details">
                                        <h5><i class="fas fa-birthday-cake"></i>
                                            {{-- get the birth date and the age --}}
                                            @php
                                                $date = date_create(Auth::user()->birthdate);
                                                $diff = date_diff($date, date_create(date('Y-m-d')));
                                            @endphp
                                            {{ date_format($date, 'j M Y') }}, {{ $diff->format('%y '.__('website\includes\sidebar.years')) }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    @if (Auth::guard('web')->check())
                                        <li class="@if (Request::url()==route('appointment.index')) {{ 'active' }} @endif">
                                            <a href="{{route('appointment.index')}}">
                                                <i class="far fa-calendar-alt"></i>
                                                <span>{{__('website\includes\sidebar.appts')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('user.profile')) {{ 'active' }} @endif">
                                            <a href="{{ route('user.profile') }}">
                                                <i class="fas fa-user-cog"></i>
                                                <span>{{__('website\includes\sidebar.profile')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('user.changepass')) {{ 'active' }} @endif">
                                            <a href="{{ route('user.changepass') }}">
                                                <i class="fas fa-lock"></i>
                                                <span>{{__('website\includes\sidebar.changepass')}}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('user.logout') }}" class="d-inline">
                                                @csrf<button class="btn btn-link dropdown-item btn-lg bg-primary"
                                                    href="{{ route('user.logout') }}">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                    <span>{{__('website\includes\sidebar.logout')}}</span>
                                                </button>
                                            </form>
                                        </li>
                                    @elseif(Auth::guard('doc')->check())
                                        <li class="@if (Request::url()==route('clinics.index')) {{ 'active' }} @endif">
                                            <a href="{{ route('clinics.index') }}">
                                                <i class="fas fa-clinic-medical"></i>
                                                <span>{{__('website\includes\sidebar.clinics')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('doctor.profile')) {{ 'active' }} @endif">
                                            <a href="{{ route('doctor.profile') }}">
                                                <i class="fas fa-user-cog"></i>
                                                <span>{{__('website\includes\sidebar.profile')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('doctor.info')) {{ 'active' }} @endif">
                                            <a href="{{ route('doctor.info') }}">
                                                <i class="fas fa-info-circle"></i>
                                                <span>{{__('website\includes\sidebar.info')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('doctor.certificate')) {{ 'active' }} @endif">
                                            <a href="{{ route('doctor.certificate') }}">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>{{__('website\includes\sidebar.cert')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('doctor.experience')) {{ 'active' }} @endif">
                                            <a href="{{ route('doctor.experience') }}">
                                                <i class="fas fa-briefcase"></i>
                                                <span>{{__('website\includes\sidebar.exp')}}</span>
                                            </a>
                                        </li>
                                        <li class="@if (Request::url()==route('doctor.changepass')) {{ 'active' }} @endif">
                                            <a href="{{ route('doctor.changepass') }}">
                                                <i class="fas fa-lock"></i>
                                                <span>{{__('website\includes\sidebar.changepass')}}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('doctor.logout') }}"
                                                class="d-inline">
                                                @csrf<button class="btn btn-link dropdown-item btn-lg bg-primary"
                                                    href="{{ route('doctor.logout') }}">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                    <span>{{__('website\includes\sidebar.logout')}}</span>
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- /Profile Sidebar -->
