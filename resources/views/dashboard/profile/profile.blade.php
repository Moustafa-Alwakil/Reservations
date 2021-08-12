@extends('dashboard.layouts.layout')
@section('title', 'Profile')
@section('content')
@include('dashboard.includes.pageHeader1')
Profile
@include('dashboard.includes.pageHeader2')
<li class="breadcrumb-item">Profile</li>
@include('dashboard.includes.pageHeader3')

<div class="row">
    <div class="col-md-12">
        <div class="tab-content profile-tab-cont">

            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">
				@include('website.includes.sessionDisplay')
                <!-- Personal Details -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                            class="fa fa-edit mr-1"></i>Edit</a>
                                </h5>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                    <p class="col-sm-10">{{ucwords(Auth::guard('admin')->user()->name)}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                    <p class="col-sm-10">{{Auth::guard('admin')->user()->email}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Details Modal -->
                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Personal Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('admin.profile.update')}}">
											@csrf
                                            <div class="row form-row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ucwords(Auth::guard('admin')->user()->name)}}">
                                                    </div>
                                                </div>
												@error('name')
													<div class="alert alert-danger">{{$message}}</div>
												@enderror
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" value="{{Auth::guard('admin')->user()->email}}">
                                                    </div>
                                                </div>
												@error('email')
												<div class="alert alert-danger">{{$message}}</div>
											@enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save
                                                Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Details Modal -->

                    </div>


                </div>
                <!-- /Personal Details -->

            </div>
            <!-- /Personal Details Tab -->

        </div>
    </div>
</div>
@endsection
