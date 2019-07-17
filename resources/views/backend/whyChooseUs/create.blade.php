@extends('backend.layouts.app')

@section('title','whyChooseUs')

@push('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           ADD NEW whyChooseUs
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.whychooseus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="title">
                                    <label class="form-label">whyChooseUs Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="description">
                                    <label class="form-label">whyChooseUs Description</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div class="form-line">
                                        <select id="dropdown" class="form-control show-tick" name="icon_id" style="font-family: 'FontAwesome', Helvetica;">
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