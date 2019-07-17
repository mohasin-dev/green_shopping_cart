@extends('backend.layouts.app')

@section('title','Font Awesome')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                          Edit font Awesome
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.fontAwesome.update',$fontAwesome->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="icon" value="{{ $fontAwesome->icon }}">
                                    <label class="form-label">font Awesome Icon Code</label>
                                </div>
                            </div>
                 
                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.fontAwesome.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush