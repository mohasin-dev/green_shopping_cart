@extends('backend.layouts.app')

@section('title','Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT PRODUCT
                            </h2>
                        </div>
                        <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->product_title }}" id="title" class="form-control" name="product_title">
                                        <label class="form-label">Product Title</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->product_short_description }}" id="short_description" class="form-control" name="product_short_description">
                                        <label class="form-label">Short Description</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="product_image">
                                </div>

                                <div class="">
                                    <h4>
                                       Present Image
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset($product->product_image) }}" width="200">
                                </div><br>


                            <div class="form-group">
                                <input type="checkbox" name="is_discount" id="basic_checkbox_2" class="filled-in" {{ $product->is_discount == 1 ? 'checked' : '' }}>
                                        <label for="basic_checkbox_2">Is Discount?</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_featured" id="basic_checkbox_3" class="filled-in" {{ $product->is_featured == 1 ? 'checked' : '' }}>
                                        <label for="basic_checkbox_3">Is Featured?</label>
                            </div>
                            <div class="form-group">
                                <label for="old_password">Discount Type : </label>
                                        <input {{ $product->discount_type == 1 ? 'selected' : '' }} name="discount_type" type="radio" class="with-gap" id="radio_3" value="1">
                                        <label for="radio_3">Fixed Taka</label>
                                        <input {{ $product->discount_type == 2 ? 'selected' : '' }} name="discount_type" type="radio" class="with-gap" id="radio_4" value="0">
                                        <label for="radio_4">Percentage</label>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="subcategory_id">
                                        <option>Select a Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>{{$subcategory->subcategory_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tag">Select Tag</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option
                                                @foreach($product->tags as $product_tag)
                                                    {{ $product_tag->id == $tag->id ? 'selected' : '' }}
                                                @endforeach
                                                value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('sizes') ? 'focused error' : '' }}">
                                    <label for="tag">Select Sizes</label>
                                    <select name="sizes[]" id="size" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                                <div class="header">
                                    <h2>
                                       Description
                                    </h2>
                                </div>
                                <div class="body">
                                    <textarea id="tinymce" name="product_description">value="{{ $product->product_description }}"</textarea>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="stock" class="form-control" value="{{ $product->stock }}" name="stock">
                                        <label class="form-label">Stock</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="stock" value="{{ $product->stock_alert }}" class="form-control" name="stock_alert">
                                        <label class="form-label">Stock Alert</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->purchase_price }}" id="purchase_price" class="form-control" name="purchase_price">
                                        <label class="form-label">Purchase_price</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->sale_price }}" id="sale_price" class="form-control" name="sale_price">
                                        <label class="form-label">Sale_price</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="old_password">Size Type : </label>
                                    <input name="size_type" type="radio" class="with-gap" id="radio_5" value="1">
                                    <label for="radio_3">Fixed Size</label>
                                    <input name="size_type" type="radio" class="with-gap" id="radio_6" value="2">
                                    <label for="radio_4">Approximate Size</label>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="size_id">
                                            <option>Select a Size</option>
                                            @foreach ($sizes as $size)
                                            <option value="{{$size->id}}" {{ $size->id == $product->size_id ? 'selected' : '' }}>{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="unit_id">
                                            <option>Select a Unit</option>
                                            @foreach ($units as $unit)
                                            <option value="{{$unit->id}}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{$unit->unit_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>

@endpush
