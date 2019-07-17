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
                                        <label class="form-label">Product Title<span style="color: red; font-size: 18px;">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->product_short_description }}" id="short_description" class="form-control" name="product_short_description">
                                        <label class="form-label">Short Description</label>
                                    </div>
                                </div>

                                <div class="">
                                    <h4>
                                        Current Product Image
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/product/'.$product->product_image) }}" width="200">
                                </div><br>

                                <div class="form-group">
                                    <label for="image">Product Image<span style="color: red; font-size: 18px;">*</span></label>
                                    <input type="file" name="product_image">
                                </div>

                                    <div class="">
                                        <h4>
                                            Current Gallery Images
                                        </h4>
                                    </div>
                                    @php
                                    // $images = DB::table('product_images')
                                    // ->select('product_images.*')
                                    // ->where('product_images.product_id', $product->id)
                                    // ->get();
                                    @endphp
                                    @if ($product->images)
                                    <div class="">
                                        @foreach ($product->images as $item)
                                        <img src="{{ asset('images/gallery/thumb/' .$item->image )}}">
                                        @endforeach
                                    </div><br>
                                    @endif

                                <div class="form-group">
                                    <label for="image">Gallery Image1<span style="color: red; font-size: 18px;">*</span></label>
                                    <input type="file" name="image[]">
                                </div>
                                <div class="form-group">
                                    <label for="image">Gallery Image2</label>
                                    <input type="file" name="image[]">
                                </div>
                                <div class="form-group">
                                    <label for="image">Gallery Image3</label>
                                    <input type="file" name="image[]">
                                </div>
                                <div class="form-group">
                                    <label for="image">Gallery Image4</label>
                                    <input type="file" name="image[]">
                                </div>

                            <div class="form-group">
                                <input type="checkbox" name="featured" id="basic_checkbox_7" class="filled-in" {{ $product->featured == 1 ? 'checked' : '' }}>
                                <label for="basic_checkbox_7">Is Featured?</label>
                            </div>
                            <div class="form-group">
                                    <input type="checkbox" name="hot_product" id="basic_checkbox_6" class="filled-in" {{ $product->hot_product == 1 ? 'checked' : '' }}>
                                            <label for="basic_checkbox_6">Is Hot Product?</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="hot_deal" id="basic_checkbox_5" class="filled-in" {{ $product->hot_deal == 1 ? 'checked' : '' }}>
                                            <label for="basic_checkbox_5">Is Hot Deal?</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="special_offer" id="basic_checkbox_4" class="filled-in" {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                            <label for="basic_checkbox_4">Is Special Offer?</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="special_deal" id="basic_checkbox_3" class="filled-in" {{ $product->special_deal == 1 ? 'checked' : '' }}>
                                            <label for="basic_checkbox_3">Is Special Deal?</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="discount" id="basic_checkbox_2" class="filled-in" {{ $product->discount == 1 ? 'checked' : '' }}>
                                            <label for="basic_checkbox_2">Is Discount?</label>
                                </div>
                                 <div class="form-group">
                                    <label for="old_password">Discount Type : </label>
                                            <input {{ $product->discount_type == 1 ? 'checked' : '' }} name="discount_type" type="radio" class="with-gap" id="radio_3" value="1">
                                            <label for="radio_3">Fixed Taka</label>
                                            <input {{ $product->discount_type == 2 ? 'checked' : '' }} name="discount_type" type="radio" class="with-gap" id="radio_4" value="2">
                                            <label for="radio_4">Percentage</label>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="discount_amount" value="{{ $product->discount_amount }}" class="form-control" name="discount_amount">
                                        <label class="form-label">Discount Amount</label>
                                    </div>
                                </div>
                            {{-- <div class="form-group">
                                <input type="checkbox" name="is_discount" id="basic_checkbox_2" class="filled-in" {{ $product->is_discount == 1 ? 'checked' : '' }}>
                                <label for="basic_checkbox_2">Is Discount?</label>
                            </div>
                            <div class="form-group">
                                <label for="old_password">Discount Type : </label>
                                        <input {{ $product->discount_type == 1 ? 'selected' : '' }} name="discount_type" type="radio" class="with-gap" id="radio_3" value="1">
                                        <label for="radio_3">Fixed Taka</label>
                                        <input {{ $product->discount_type == 2 ? 'selected' : '' }} name="discount_type" type="radio" class="with-gap" id="radio_4" value="0">
                                        <label for="radio_4">Percentage</label>
                            </div> --}}
                            {{-- <div class="form-group">
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
                            </div> --}}
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
                            <div class="form-group">
                                <div class="form-line">
                                        <label for="color">Select category<span style="color: red!important; font-size: 18px;">*</span></label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}"  {{ $category->id == $product->category_id ? 'selected' : '' }}>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="form-line">
                                        <label for="color">Select Subcategory<span style="color: red!important; font-size: 18px;">*</span></label>
                                    <select class="subcategory_id form-control" name="subcategory_id" id="subcategory_id">
                                        <option value="">Select a Subcategory</option>
                                        @foreach ($product->category->subcategory as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tag">Select Tags</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick tag_id" data-live-search="true" multiple>
                                        <option>Select Some Tags</option>
                                        {{-- @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                                <div class="header">
                                    <h2>
                                       Description<span style="color: red; font-size: 18px;">*</span>
                                    </h2>
                                </div>
                                <div class="body">
                                    <textarea id="tinymce" name="product_description">{!! $product->product_description !!}</textarea>
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
                                        <label class="form-label">Purchase Price</label>
                                    </div>
                                </div>
                                @if ($product->discount)
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->sale_price }}" id="sale_price" class="form-control" name="regular_price">
                                        <label class="form-label">Sale Price</label>
                                    </div>
                                </div>
                                @else
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $product->regular_price }}" id="sale_price" class="form-control" name="regular_price">
                                        <label class="form-label">Sale Price</label>
                                    </div>
                                </div>
                                @endif


                                    <div class="form-group form-float">
                                        <div class="form-line {{ $errors->has('colors') ? 'focused error' : '' }}">
                                            <label for="color">Select Colors</label>
                                            <select name="colors[]" id="color" size="5" class="form-control show-tick" data-live-search="true" multiple>
                                                <option value="">Select a color</option>
                                                @foreach($colors as $color)
                                                    <option
                                                    @foreach($product->colors as $product_color)
                                                    {{ $product_color->id == $color->id ? 'selected' : '' }}
                                                    @endforeach
                                                    value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="size_id">
                                            <option value="">Select a size</option>
                                            @foreach ($sizes as $size)
                                            <option value="{{$size->id}}" {{ $size->id == $product->size_id ? 'selected' : '' }}>{{$size->size_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="unit_id">
                                            <option value="">Select a Unit</option>
                                            @foreach ($units as $unit)
                                            <option value="{{$unit->id}}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{$unit->unit_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.product.index') }}">BACK</a>
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
    {{-- <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script> --}}
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
                // $('#category_id').change(function(){
                // var category_id = ($(this).val());
                // //alert(category_id);
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // $.ajax({
                //     type: "POST",
                //     data: {category_id: category_id},
                //     url: "{{ route('admin.subcategory') }}",
                //     success: function(data){
                //     $(".subcategory_id").html(data);
                //     //alert(data);
                //     }
                // });

                $('#subcategory_id').change(function(){
                var subcategory_id = ($(this).val());
                    $.ajax({
                        type: "POST",
                        data: {subcategory_id: subcategory_id},
                        url: "{{ route('admin.tag') }}",
                        success: function(data){
                        $(".tag_id").html(data);
                        //alert(data);
                        }
                    });
                });
            });
        })
    </Script>

@endpush
