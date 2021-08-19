@extends('dashboard.layouts.layout')
@section('title', 'Edit Review')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Reviiews
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Reviiews</li>
    <li class="breadcrumb-item">Edit Review</li>
    @include('dashboard.includes.pageHeader3')
    <div class="row">
        <div class="col-12">
            @include('website.includes.sessionDisplay')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Review</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reviews.update', ['review' => $review->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $review->title }}">
                        </div>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea name="comment" class="form-control">{{ $review->comment }}</textarea>
                        </div>
                        @error('comment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Old Rate</label>
                            <div class="rating">
                                @for ($i = 0; $i < $review->value; $i++)
                                    <i class="fas fa-star filled"></i>
                                @endfor
                                @for ($i = 0; $i < 5 - $review->value; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="form-group">
                            <label>New Rate</label>
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
                        </div>
                        @error('value')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>User</label>
                            <select class="form-control" name="user_id">
                                <option disabled selected>Select user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($review->user->id == $user->id) {{ 'selected' }} @endif>{{ ucwords($user->name['fname'] . ' ' . $user->name['lname']) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Doctor</label>
                            <select class="form-control" name="physican_id">
                                <option disabled selected>Select soctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @if ($review->physican->id == $doctor->id) {{ 'selected' }} @endif>
                                        {{ ucwords($doctor->name['fname_ar'] . ' ' . $doctor->name['lname_ar']) }} -
                                        {{ ucwords($doctor->name['fname_en'] . ' ' . $doctor->name['lname_en']) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('physican_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
