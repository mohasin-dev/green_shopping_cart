@extends('frontend.app')

@section('title', 'Product Details')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/x-zoom/xzoom.css') }}">
@endpush

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('category.product', $product->category->id) }}">{{ $product->category->category_name }}</a></li>
                    <li class='active'>{{ $product->product_title }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">


                    <div class="side-menu animate-dropdown">
                        <div class="head"><i class="icon fa fa-bars"></i> Categories</div>
                        <nav class="yamm megamenu-horizontal">
                            <ul class="nav">
                                    {{-- <i class="icon fa fa-shopping-bag" aria-hidden="true"></i> --}}
                            @foreach ($navCategories as $navCategory)
                                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $navCategory->category_name }}</a>
                                    <ul class="dropdown-menu mega-menu">
                                    <li class="yamm-content">
                                        <div class="row">
                                            @php
                                                $navSubCategories = App\Subcategory::where('category_id', $navCategory->id)->get();
                                            @endphp
                                        @foreach ($navSubCategories as $navSubCategory)

                                        <div class="col-sm-12 col-md-3 for-right-border">
                                            <ul class="links list-unstyled">
                                            <li><a href="{{ route('subCategory.product', $navSubCategory->id) }}">{{ $navSubCategory->subcategory_name }}</a></li>
                                            </ul>
                                        </div>
                                        @endforeach

                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- /.yamm-content -->
                                    </ul>
                                    <!-- /.dropdown-menu -->
                                </li>
                                @endforeach

                            {{-- <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
                                <!-- /.dropdown-menu --> </li>
                            <!-- /.menu-item -->

                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                <!-- /.dropdown-menu -->
                                <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
                            <!-- /.menu-item -->

                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
                                <!-- /.dropdown-menu --> </li> --}}
                            <!-- /.menu-item -->

                            </ul>
                            <!-- /.nav -->
                        </nav>
                        <!-- /.megamenu-horizontal -->
                    </div>


                    <div class="home-banner outer-top-n">
                    <img src="{{ asset('/images/setting/'. setting()->banner5) }}" alt="Image">
                    </div>



    <!-- ============================================== HOT DEALS ============================================== -->
                <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">hot deals</h3>
                    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                      @foreach ($hotDeals as $hotDeal)
                      <div class="item">
                        <div class="products">
                          <div class="hot-deal-wrapper">
                            <a href="{{ route('product.details', $hotDeal->product_slug) }}"><div class="image"> <img src="{{ asset('images/product/'. $hotDeal->product_image) }}" alt=""> </div></a>
                            <div class="sale-offer-tag"><span>{{ $hotDeal->discount_amount }}%<br>
                              off</span></div>
                            <div class="timing-wrapper">
                              <div class="box-wrapper">
                                <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                              </div>
                              <div class="box-wrapper">
                                <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                              </div>
                              <div class="box-wrapper">
                                <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                              </div>
                              <div class="box-wrapper hidden-md">
                                <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.hot-deal-wrapper -->

                          <div class="product-info text-left m-t-20">
                            <h3 class="name"><a href="{{ route('product.details', $hotDeal->product_slug) }}">{{ $hotDeal->product_title }}</a></h3>

                            <?php
                            $count = $hotDeal->reviews()->count();
                            if($hotDeal->reviews->count() > 0){
                                $total = 0;
                                foreach($hotDeal->reviews as $review){
                                $total += $review->star;
                                }
                                $result = $total/$count;
                            }else{
                                $result = 0;
                            }
                            if($result != 0){

                                if($result > 3 && $result < 4){
                                ?>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star-half-o"></i>
                                <i class="icon star fa fa-star-o"></i>
                                <?php
                                }elseif($result > 4 && $result < 5){
                                ?>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star-half-o"></i>
                                <?php
                                }elseif($result == 5){
                                ?>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <?php
                                }else{
                                    ?>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star"></i>
                                <i class="icon star fa fa-star-o"></i>
                                <i class="icon star fa fa-star-o"></i>
                                <?php
                                }
                            }
                            ?>
                            <div class="product-price"> <span class="price">{{ price_format($hotDeal->regular_price) }} </span> <span class="price-before-discount">{{ price_format($hotDeal->sale_price) }}</span> </div>
                            <!-- /.product-price -->

                          </div>
                          <!-- /.product-info -->

                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <div class="add-cart-button btn-group">
                                {{-- <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button> --}}
                                <button class="btn btn-primary icon atc" name="{{ $hotDeal->id }}" type="button" > <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn atc" name="{{ $hotDeal->id }}" type="button">Add to cart</button>
                              </div>
                            </div>
                            <!-- /.action -->
                          </div>
                          <!-- /.cart -->
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <!-- /.sidebar-widget -->
                </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->


    <div style="padding-bottom: 54px;" class="home-banner hidden-sm hidden-xs"> <img src="{{ asset('/images/setting/'. setting()->banner6) }}" alt="Image"> </div>

    <div style="padding-top: 60px;" class="home-banner outer-top-n">
        <img src="{{ asset('/images/setting/'. setting()->banner5) }}" alt="Image">
    </div>


                    </div>
                </div><!-- /.sidebar -->


                <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-6 gallery-holder">
                            <div class="large-5 column">
                                <div class="xzoom-container">
                                    @if ($product->images)
                                        @foreach ($product->images as $image)
                                        <img class="xzoom" id="xzoom-default" src="{{ asset('images/gallery/preview/'. $image->image) }}" xoriginal="{{ asset('images/gallery/original/'. $image->image) }}" />
                                        @php
                                            break;
                                        @endphp
                                        @endforeach
                                    <div class="xzoom-thumbs">
                                        @foreach ($product->images as $image)
                                        <a href="{{ asset('images/gallery/original/'. $image->image) }}"><img class="xzoom-gallery" width="80" src="{{ asset('images/gallery/thumb/'. $image->image) }}"  xpreview="{{ asset('images/gallery/preview/'. $image->image) }}"></a>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-6 product-info-block'>
                            <div style="padding-left: 20px;" class="product-info">
                                <h1 class="name">{{ $product->product_title }}</h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        @if($result != 0)
                                        <div class="col-sm-4">
                                            @if($result > 3 && $result < 4)
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star-half-o"></i>
                                            <i class="icon star fa fa-star-o"></i>
                                            @elseif($result > 4 && $result < 5)
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star-half-o"></i>
                                            @elseif($result == 5)
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            @else
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star"></i>
                                            <i class="icon star fa fa-star-o"></i>
                                            <i class="icon star fa fa-star-o"></i>
                                            @endif
                                        </div>
                                        @else
                                        <span style="padding-left: 12px;">No review available, Be the Fist one.</span>
                                        @endif
                                        <div class="col-sm-8">
                                            @if ($product->reviews)
                                            <div class="reviews">
                                                <a href="#" class="lnk">({{ $product->reviews->count() }} Reviews)</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span style="padding-left: 20px;" class="value">In Stock</span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Sizes :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">

                                            <div class="stock-box">
                                                @if($product->size)
                                               {{ $product->size->size_name }}
                                               @endif
                                            </div>

                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">

                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Colors :</span>
                                            </div>
                                        </div>
                                        @if ($product->colors)
                                        <div class="col-sm-9">
                                            <div class="stock-box">

                                                @foreach ($product->colors as $color)
                                                <label class="radio-inline">
                                                    <input type="radio" name="color" id="option1" value="{{ $color->id }}">{{ $color->color_name }}
                                                </label>

                                                @endforeach
                                                <br>
                                                @foreach ($product->colors as $color)
                                                <div class="p-color" style="display: inline-block; height: 15px; width: 15px;
                                                border-radius: 50%; background-color: {{ $color->color_code }}"></div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                        {{ $product->product_short_description }}
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price">{{ price_format($product->regular_price) }}</span>
                                                <span class="price-strike">{{ price_format($product->sale_price) }}</span>
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                   <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div> --}}

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        {{-- <div class="col-sm-2">
                                            <span class="label">Qty :</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                      <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                      <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                    </div>
                                                    <input type="text" value="1">
                                              </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-sm-7">
                                                {{-- <button class="btn btn-primary icon atc" name="{{ $NewArrivalProduct->id }}" type="button" > <i class="fa fa-shopping-cart"></i> </button> --}}

                                            <a href="#" class="btn btn-primary atc" name="{{ $product->id }}"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                                        </div>


                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->






                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                    {{-- <li><a data-toggle="tab" href="#tags">TAGS</a></li> --}}
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">{!! $product->product_description !!}</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
                                                                                                            </div>

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->



                                            <div class="product-add-review">
                                                <form action="{{ route('review') }}" role="form" method="POST" class="cnt-form">
                                                    @csrf
                                                <h4 class="title">Write your own review</h4>
                                                <div class="review-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-label">&nbsp;</th>
                                                                    <th>1 star</th>
                                                                    <th>2 stars</th>
                                                                    <th>3 stars</th>
                                                                    <th>4 stars</th>
                                                                    <th>5 stars</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-label">Quality</td>
                                                                    <td>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="quality" id="option1" value="1">
                                                                        </label>                                                                    </td>
                                                                    <td>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="quality" id="option1" value="2">
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="quality" id="option1" value="3">
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="quality" id="option1" value="4">
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="quality" id="option1" value="5">
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="cell-label">Price</td>
                                                                    <td><input type="radio" name="price" class="radio" value="1"></td>
                                                                    <td><input type="radio" name="price" class="radio" value="2"></td>
                                                                    <td><input type="radio" name="price" class="radio" value="3"></td>
                                                                    <td><input type="radio" name="price" class="radio" value="4"></td>
                                                                    <td><input type="radio" name="price" class="radio" value="5"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table><!-- /.table .table-bordered -->
                                                    </div><!-- /.table-responsive -->
                                                </div><!-- /.review-table -->

                                                <div class="review-form">
                                                    <div class="form-container">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control txt" id="exampleInputName" placeholder="">
                                                                        <input type="text" name="name" class="form-control txt" id="exampleInputName" placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                    <div class="form-group">
                                                                        <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                        <input type="text" name="summery" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                        <textarea name="review" class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                    </div><!-- /.form-group -->
                                                                </div>
                                                            </div><!-- /.row -->

                                                            <div class="action text-right">
                                                                @auth
                                                                <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                                @else
                                                                <a href="{{ route('review.login') }}" type="button" class="btn btn-primary btn-upper">SUBMIT REVIEW</a>
                                                                @endauth
                                                            </div><!-- /.action -->

                                                        </form><!-- /.cnt-form -->
                                                    </div><!-- /.form-container -->
                                                </div><!-- /.review-form -->

                                            </div><!-- /.product-add-review -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    {{-- <div id="tags" class="tab-pane">
                                        <div class="product-tag">

                                            <h4 class="title">Product Tags</h4>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-container">

                                                    <div class="form-group">
                                                        <label for="exampleInputTag">Add Your Tags: </label>
                                                        <input type="email" id="exampleInputTag" class="form-control txt">


                                                    </div>

                                                    <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                                </div><!-- /.form-container -->
                                            </form><!-- /.form-cnt -->

                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                                </div>
                                            </form><!-- /.form-cnt -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane --> --}}

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
    <section class="section featured-product wow fadeInUp">
        <h3 class="section-title">upsell products <span style="float: right; padding-right: 70px;"><a href="{{ route('upsale.product') }}">All</a></span></h3>
        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
             @foreach ($newProductss as $upsaleProduct)
            <div class="item item-carousel">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image">
                                <a href="{{ route('product.details', $upsaleProduct->product_slug) }}"><img  src="{{ asset('images/product/'. $upsaleProduct->product_image) }}" alt=""></a>
                            </div><!-- /.image -->

                            <div class="tag sale"><span>sale</span></div>
                        </div><!-- /.product-image -->


                        <div class="product-info text-left">
                            <h3 class="name"><a href="{{ route('product.details', $upsaleProduct->product_slug) }}">{{ $upsaleProduct->product_title }}</a></h3>

                                    <?php
                                    $count = $upsaleProduct->reviews()->count();
                                    if($upsaleProduct->reviews->count() > 0){
                                        $total = 0;
                                        foreach($upsaleProduct->reviews as $review){
                                        $total += $review->star;
                                        }
                                        $result = $total/$count;
                                    }else{
                                        $result = 0;
                                    }
                                    if($result != 0){

                                        if($result > 3 && $result < 4){
                                        ?>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star-half-o"></i>
                                        <i class="icon star fa fa-star-o"></i>
                                        <?php
                                        }elseif($result > 4 && $result < 5){
                                        ?>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star-half-o"></i>
                                        <?php
                                        }elseif($result == 5){
                                        ?>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <?php
                                        }else{
                                            ?>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star"></i>
                                        <i class="icon star fa fa-star-o"></i>
                                        <i class="icon star fa fa-star-o"></i>
                                        <?php
                                        }
                                    }
                                    ?>

                            <div class="description"></div>

                            <div class="product-price">
                                <span class="price">
                                    {{ price_format($upsaleProduct->sale_price) }}				</span>
                                                            <span class="price-before-discount">{{ price_format(900) }}</span>

                            </div><!-- /.product-price -->

                        </div><!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon atc" name="{{ $upsaleProduct->id }}" data-toggle="dropdown" type="button">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}

                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart atc pointer" name="{{ $upsaleProduct->id }}" title="Add To Cart">Add to cart </a> </li>


                                    {{-- <li class="lnk wishlist">
                                        <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                        </a>
                                    </li>

                                    <li class="lnk">
                                        <a class="add-to-cart" href="detail.html" title="Compare">
                                            <i class="fa fa-signal"></i>
                                        </a>
                                    </li> --}}
                                </ul>
                            </div><!-- /.action -->
                        </div><!-- /.cart -->
                    </div><!-- /.product -->
                </div><!-- /.products -->
            </div><!-- /.item -->
            @endforeach
        </div><!-- /.home-owl-carousel -->
        </section><!-- /.section -->
    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
    <!-- /.container -->

    </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection

@push('js')
<script src="{{ asset('assets/frontend/js/x-zoom/xzoom.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/x-zoom/jquery.hammer.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/x-zoom/setup.js') }}"></script>
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(document).ready(function () {
            $(".atc").click(function (e) {
                e.preventDefault();
                var product_id = $(this).attr("name");
                var color = $('input[name=color]:checked').val();
                // var product_qty = $(".qty").val();
                //alert(color);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        data: {product_id: product_id, color: color},
                        url: "{{ route('cart.store2') }}",
                        success: function(data){
                         //alert(data);
                        //  $("#items").html(data);
                        Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data,
                        //title: 'Product Added to cart &nbsp; <i class="fa fa-check-circle fa-lg"></i>',
                        showConfirmButton: false,
                        timer: 1500,
                        });
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 2000);
                        }
                    });
                });
            });
    </script>
@endpush
