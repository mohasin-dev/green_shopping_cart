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
    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger waves-effect">BACK</a>
            <a href="{{ route('admin.edit', $admin->id )}}" class="btn btn-success waves-effect pull-right">Update Profile
            </a>

        <br>
        <br>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <div class="header bg-amber">
                                <h2>
                                    Personal Information
                                </h2>
                            </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-md-1 col-sm-12 col-xs-12"></div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                        <h4>First Name</h4>
                                        <h4>Last Name</h4>
                                        <strong>Mobile Number</strong>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                         <h4>: {{ $admin->name }}</h4>
                                         <h4>: {{ $admin->last_name }}</h4>
                                        <strong>: {{ $admin->mobile_number }}</strong>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-1 col-sm-12 col-xs-12"></div>
                                <div class="col-md-3 col-sm-12 col-xs-12" style="">
                                    <p>Email</p>
                                    <p>Address</p>
                                    <p>District</p>
                                    <p>Upazila</p>
                                    <p>Gender</p>
                                    <p>Date Of Birth</p>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12" style="">
                                     <p>: {{ $admin->email }}</p>
                                     <p>: {{ $admin->address }} </p>
                                    @php
                                    if($admin->upazila_id){
                                        $district_id = App\Upazila::find(Auth::user()->upazila_id)->district_id;
                                        $upazila_name = App\Upazila::find(Auth::user()->upazila_id)->upazila_name;
                                        $district_name = App\District::find($district_id)->district_name;
                                    }
                                    @endphp
                                    @if ($admin->upazila_id)
                                    <p>: {{ $district_name }} </p>
                                    @else
                                    <p>: </p>
                                    @endif
                                    @if ($admin->upazila_id)
                                    <p>: {{ $upazila_name }} </p>
                                    @else
                                    <p>: </p>
                                    @endif
                                    @if ( $admin->gender == 1)
                                     <p>: Male </p>
                                    @elseif($admin->gender == 2)
                                    <p>: Female </p>
                                    @endif
                                    <p>: {{ $admin->dob }} </p>

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
                            <img class="img-responsive thumbnail" src="{{ asset('images/user/'. $admin->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
