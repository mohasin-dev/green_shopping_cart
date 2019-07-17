@extends('backend.layouts.app')

@section('title','whyChooseUs')

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
                          Edit whyChooseUs
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.whychooseus.update',$whyChooseUs->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" value="{{$whyChooseUs->title}}" id="name" class="form-control" name="title">
                                    <label class="form-label">whyChooseUs Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" value="{{$whyChooseUs->description}}" id="name" class="form-control" name="description">
                                    <label class="form-label">whyChooseUs Description</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="icon_id">
                                            <option>Select a Icon</option>
                                            @foreach ($icons as $icon)
                                            <option value="{{$icon->id}}">{{$icon->icon}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="form-label">Font Awesome Icon</label>
                                </div>
                            </div>
                 
                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.whychooseus.index') }}">BACK</a>
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