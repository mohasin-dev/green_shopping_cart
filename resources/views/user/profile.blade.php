@extends('backend.layouts.app')

@section('title','Profile')

@push('css')
   <style>
       a.btn.btn-success.waves-effect.pull-right{
           margin-left: 10px;
       }
   </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('user.dashboard') }}" class="btn btn-danger waves-effect">BACK</a>
            <a href="{{ route('user.edit', Auth::user()->id )}}" class="btn btn-success waves-effect pull-right">Update Profile
            </a>

        <br>
        <br>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-1 col-sm-12 col-xs-12"></div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                        <h4>First Name</h4>
                                        <h4>Last Name</h4>
                                        <strong>Mobile Number</strong>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                         <h4>: {{ Auth::user()->first_name }}</h4>
                                         <h4>: {{ Auth::user()->last_name }}</h4>
                                        <strong>: {{ Auth::user()->mobile_number }}</strong>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-1 col-sm-12 col-xs-12"></div>
                                <div class="col-md-3 col-sm-12 col-xs-12" style="">
                                    <p>Email</p>
                                    <p></p>
                                    <p>Address</p>
                                    <p>District</p>
                                    <p>Upazila</p>
                                    <p>Gender</p>
                                    <p>Date Of Birth</p>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12" style="">
                                     <p>: {{ Auth::user()->email }}</p>
                                     <p>: {{ Auth::user()->address }} </p>

                                    @if (Auth::user()->upazila_id)
                                    <p>: {{ App\Upazila::find(Auth::user()->upazila_id)->first()->upazila_name }} </p>
                                    @else
                                    <p>: </p>
                                    @endif
                                    @if (Auth::user()->upazila_id)
                                     <p>: {{ App\District::find(App\Upazila::find(Auth::user()->upazila_id)->district_id)->district_name }} </p>
                                    @else
                                     <p>: </p>
                                    @endif
                                    @if ( Auth::user()->gender == 1)
                                     <p>: Male </p>
                                    @else
                                    <p>: Female </p>
                                    @endif
                                    <p>: {{ Auth::user()->dob }} </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card"> <!--bg-amber -->
                        <div class="header bg-cyan">
                            <h2>
                                Profile Picture
                            </h2>
                        </div>
                        <div class="body">
                            <img class="img-responsive thumbnail" src="{{ asset('images/user/'. Auth::user()->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
