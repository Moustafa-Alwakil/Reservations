@extends('dashboard.layouts.layout')
@section('title', 'All Reviews')
@section('content')
    @include('dashboard.includes.pageHeader1')
    Reviews
    @include('dashboard.includes.pageHeader2')
    <li class="breadcrumb-item">Reviews</li>
    <li class="breadcrumb-item">All Reviews</li>
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
                                    <th>Title</th>
                                    <th>Comment</th>
                                    <th>Rate</th>
                                    <th>User</th>
                                    <th>Doctor (Arabic)</th>
                                    <th>Doctor (English)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->title }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td>
                                            <div class="rating">
                                                @for ($i = 0; $i < $review->value; $i++)
                                                <i class="fas fa-star filled"></i>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $review->value; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            </div>
                                        </td>
                                        <td>{{ ucwords($review->user->name['fname'] . ' ' . $review->user->name['lname']) }}
                                        </td>
                                        <td>{{ ucwords($review->physican->name['fname_ar'] . ' ' . $review->physican->name['lname_ar']) }}
                                        </td>
                                        <td>{{ ucwords($review->physican->name['fname_en'] . ' ' . $review->physican->name['lname_en']) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('reviews.edit', ['review' => $review->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form method="POST" class="d-inline"
                                                action="{{ route('reviews.destroy', ['review' => $review->id]) }}">
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
