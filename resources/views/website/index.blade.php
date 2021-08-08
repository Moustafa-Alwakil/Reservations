@extends('website.layouts.layout')
@section('title')
{{__('website\layouts\layout.home')}}
@endsection
@section('content')
    <!-- Home Banner -->
    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>{{__('website\index.s1')}}</h1>
                    <p>{{__('website\index.s2')}}</p>
                </div>

                <!-- Search -->
                <div class="search-box d-flex justify-content-center">
                    <form method="get" action="{{route('show.clinics.bylocation')}}">
                        <div class="form-group search-location">
                            <select class="form-control select" name="city_id" id="city">
                                <option selected disabled>{{__('website\index.sc')}}
                                </option>
                                @isset($cities)
                                    @foreach ($cities['data'] as $city)
                                        <option value="{{ $city->id }}">
                                            {{ $city->name['name_' . LaravelLocalization::getCurrentLocale()] }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="form-group search-location">
                            <select class="form-control select" name="region_id" id="region">
                                <option selected disabled>{{__('website\index.sr')}}
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary search-btn mt-0"><i class="fas fa-search"></i>
                            <span></span></button>
                    </form>
                </div>
                <!-- /Search -->

            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <section class="section home-tile-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 m-auto">
                    <div class="section-header text-center">
                        <h2>{{__('website\index.ques')}}</h2>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-4 mb-3">
                            <div class="card text-center doctor-book-card">
                                <img src="website/assets/img/doctors/doctor-07.jpg" alt="" class="img-fluid">
                                <div class="doctor-book-card-content tile-card-content-1">
                                    <div>
                                        <h3 class="card-title mb-0">{{__('website\index.visit')}}</h3>
                                        <a href="{{route('all.clinics')}}" class="btn book-btn1 px-3 py-2 mt-3" tabindex="0">{{__('website\index.book')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@php
$locale = LaravelLocalization::getCurrentLocale();
@endphp
@section('scripts')
    <script type='text/javascript'>
        $(document).ready(function() {

            // Department Change
            $('#city').change(function() {

                // Department id
                var id = $(this).val();

                // Empty the dropdown
                $('#region').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: 'getregions/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                console.log(len);
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name
                                    .name_<?php echo $locale; ?> + "</option>";

                                $("#region").append(option);
                            }
                        }

                    }
                });
            });
        });
    </script>
@endsection
