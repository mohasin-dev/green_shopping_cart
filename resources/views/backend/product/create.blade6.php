@extends('backend.layouts.app')

@section('title','Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD NEW Product
                            </h2>
                        </div>
                        <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="product_title">
                                        <label class="form-label">Product Title</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="subtitle" class="form-control" name="product_subtitle">
                                        <label class="form-label">Product SubTitle</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="short_description" class="form-control" name="product_short_description">
                                        <label class="form-label">Short Description</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="product_image">
                                </div>

                            <div class="form-group">
                                <input type="checkbox" name="is_featured" id="basic_checkbox_3" class="filled-in">
                                        <label for="basic_checkbox_3">Is Featured?</label>
                            </div>
                            {{--<div class="form-group">
                                <input type="checkbox" name="is_discount" id="basic_checkbox_2" class="filled-in"  checked="">
                                        <label for="basic_checkbox_2">Is Discount?</label>
                            </div>
                             <div class="form-group">
                                <label for="old_password">Discount Type : </label>
                                        <input name="discount_type" type="radio" class="with-gap" id="radio_3" value="1">
                                        <label for="radio_3">Fixed Taka</label>
                                        <input name="discount_type" type="radio" class="with-gap" id="radio_4" value="2">
                                        <label for="radio_4">Percentage</label>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="discount_amount" class="form-control" name="discount_amount">
                                    <label class="form-label">Discount Amount</label>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" id="category_id" name="category_id">
                                        <option>Select a Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="form-line">
                                    <select class="subcategory_id form-control" name="subcategory_id">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tag">Select Tag</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="header">
                                    <h2>
                                       Description
                                    </h2>
                                </div>
                                <div class="body">
                                    <textarea id="tinymce" name="product_description"></textarea>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="stock" class="form-control" name="stock">
                                        <label class="form-label">Stock</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="stock" class="form-control" name="stock_alert">
                                        <label class="form-label">Stock Alert</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="purchase_price" class="form-control" name="purchase_price">
                                        <label class="form-label">Purchase_price</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="sale_price" class="form-control" name="sale_price">
                                        <label class="form-label">Sale_price</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="old_password">Size Type : </label>
                                    <input name="size_type" type="radio" class="with-gap" id="radio_5" value="1">
                                    <label for="radio_5">Fixed Size</label>
                                    <input name="size_type" type="radio" class="with-gap" id="radio_6" value="2">
                                    <label for="radio_6">Approximate Size</label>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="size_id">
                                            <option>Select a Size</option>
                                            @foreach ($sizes as $size)
                                            <option value="{{$size->id}}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="unit_id">
                                            <option>Select a Unit</option>
                                            @foreach ($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
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



<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD NEW Product
                            </h2>
                        </div>
                        <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="product_title">
                                        <label class="form-label">Product Title</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="subtitle" class="form-control" name="product_subtitle">
                                        <label class="form-label">Product SubTitle</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="short_description" class="form-control" name="product_short_description">
                                        <label class="form-label">Short Description</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="product_image">
                                </div>

                            <div class="form-group">
                                <input type="checkbox" name="is_featured" id="basic_checkbox_3" class="filled-in">
                                        <label for="basic_checkbox_3">Is Featured?</label>
                            </div>
                            {{--<div class="form-group">
                                <input type="checkbox" name="is_discount" id="basic_checkbox_2" class="filled-in"  checked="">
                                        <label for="basic_checkbox_2">Is Discount?</label>
                            </div>
                             <div class="form-group">
                                <label for="old_password">Discount Type : </label>
                                        <input name="discount_type" type="radio" class="with-gap" id="radio_3" value="1">
                                        <label for="radio_3">Fixed Taka</label>
                                        <input name="discount_type" type="radio" class="with-gap" id="radio_4" value="2">
                                        <label for="radio_4">Percentage</label>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="discount_amount" class="form-control" name="discount_amount">
                                    <label class="form-label">Discount Amount</label>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <select class="category_id form-control" id="category_id" name="category_id">

                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>

                            </div>

                             <div class="form-group">
                                <div class="form-line">
                                    <select class="subcategory_id form-control" name="subcategory_id">

                                    </select>
                                </div>
                            </div>

                            {{-- <div class="row align-items-center mt-4">
                                <div class="col">
                                    <select id="category_id" name="category_id" value="{{ old('category_id') }}" class="category_id form-control">
                                        <option value="0">Select a Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>
                            <div class="row align-items-center mt-4">
                                <div class="col">
                                        <select name="subcategory_id" value="{{ old('subcategory_id') }}" class="subcategory_id form-control">
                                            <option value="0">Select a subcategory</option>
                                        </select>
                                </div>
                        </div> --}}

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tag">Select Tag</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="header">
                                    <h2>
                                       Description
                                    </h2>
                                </div>
                                <div class="body">
                                    <textarea id="tinymce" name="product_description"></textarea>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="stock" class="form-control" name="stock">
                                        <label class="form-label">Stock</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="stock" class="form-control" name="stock_alert">
                                        <label class="form-label">Stock Alert</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="purchase_price" class="form-control" name="purchase_price">
                                        <label class="form-label">Purchase_price</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="sale_price" class="form-control" name="sale_price">
                                        <label class="form-label">Sale_price</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="old_password">Size Type : </label>
                                    <input name="size_type" type="radio" class="with-gap" id="radio_5" value="1">
                                    <label for="radio_5">Fixed Size</label>
                                    <input name="size_type" type="radio" class="with-gap" id="radio_6" value="2">
                                    <label for="radio_6">Approximate Size</label>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="size_id">
                                            <option>Select a Size</option>
                                            @foreach ($sizes as $size)
                                            <option value="{{$size->id}}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="unit_id">
                                            <option>Select a Unit</option>
                                            @foreach ($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
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


@push('js')
    <!-- Select Plugin Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script> -->
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

<script>
    $(document).ready(function(){
            $('#category_id').change(function(){
            var category_id = ($(this).val());
            //alert(category_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                data: {category_id: category_id},
                url: "{{ route('admin.subcategory') }}",
                success: function(data){
                $(".subcategory_id").html(data);
                //alert(data);
                }
            });
        });
    })

</Script>

@endpush
