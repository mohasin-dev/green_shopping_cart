@extends('frontend.app')
@section('title', 'Home')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.css') }}">
<style>
        .live-breaking-news {
            display: block;
            width: 100%;
            border: solid 1px #e40046;
            background: transparent;
            height: 40px;
            box-sizing: border-box;
            position: relative;
            line-height: 40px;
            overflow: hidden;
            border-radius: 2px;
            text-align: auto;
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: -18px;
        }
        .live-label {
            left: 0;
            top: 0;
            bottom: 0;
            height: 100%;
            position: absolute;
            background-color: #e40046;
            text-align: center;
            color: #FFF;
            font-weight: 700;
            z-index: 3;
            padding: 0 15px;
            white-space: nowrap;
        }
        .live-news {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            height: 100%;
            right: 0;
            overflow: hidden;
        }
        .swal2-modal{
        /* height: 120px; */
        /* background-color: #c3e6cb; */
        }
        /* .swal2-popup{
            padding: 10px 0 5px 0!important;
        }
        .swal2-popup .swal2-title{
            color: #155724;
        } */
    </style>
@endpush

@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding: 0 0;">
                    <div class="live-breaking-news" id="newsTicker14">
                        <div class="live-label">লাইভ</div>
                        <div class="live-news">
                            <marquee onmouseover="this.stop()" onmouseout="this.start()" width="100%" style="color:green;" scrollamount="5">{{ setting()->live_news }}</marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
        .dropdown:hover .dropdown-menu {
        display: block;
        /* margin-top: 0; // remove the gap so it doesn't close */
        }
        </style>
        <div class="body-content outer-top-vs" id="top-banner-and-menu">
          <div class="container">
          <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-3 sidebar" style="padding: 0 0;">        <!-- ================================== TOP NAVIGATION ================================== -->
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
                                    <li><a class="subcat" href="{{ route('subCategory.product', $navSubCategory->id) }}">{{ $navSubCategory->subcategory_name }}</a></li>
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
                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
                <div class="app-img outer-bottom-xs" style="margin-top: 10px;"><img alt="app" src="{{ asset('images/setting/' .setting()->banner5) }}" /></div>
                 </div>

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="padding: 0 0; margin-top: -1px;">
           <div id="hero">
                  <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                    @foreach ($sliders as $slider)
                    <div class="item" style="background-image: url({{ asset('images/slider/'. $slider->image) }}">
                      <div class="container-fluid">
                        <div class="caption bg-color vertical-center text-left">
                          @if ($slider->branding)
                          <div class="slider-header fadeInDown-1">{{ $slider->branding }}</div>
                          @endif
                          <div class="big-text fadeInDown-1">{{ $slider->title }}</div>
                          <div class="excerpt fadeInDown-2 hidden-xs"> <span>{!! $slider->description !!}</span> </div>
                          <div class="button-holder fadeInDown-3"> <a href="{{ route('new.product') }}" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                        </div>
                        <!-- /.caption -->
                      </div>
                      <!-- /.container-fluid -->
                    </div>
                    @endforeach
                    <!-- /.item -->



                  </div>
                  <!-- /.owl-carousel -->
                </div>
                <div class="info-boxes wow fadeInUp">
                  <div class="info-boxes-inner">
                    <div class="row">
                      <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="info-box">
                          <div class="row">
                            <div class="col-xs-12">
                              <h4 class="info-box-heading green">money back</h4>
                            </div>
                          </div>
                          <h6 class="text">30 Days Money Back Guarantee</h6>
                        </div>
                      </div>
                      <!-- .col -->

                      <div class="hidden-md col-sm-4 col-lg-4">
                        <div class="info-box">
                          <div class="row">
                            <div class="col-xs-12">
                              <h4 class="info-box-heading green">free shipping</h4>
                            </div>
                          </div>
                          <h6 class="text">Shipping on orders over ৳3000+</h6>
                        </div>
                      </div>
                      <!-- .col -->

                      <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="info-box">
                          <div class="row">
                            <div class="col-xs-12">
                              <h4 class="info-box-heading green">Special Sale</h4>
                            </div>
                          </div>
                          <h6 class="text">Extra ৳5 off on all items </h6>
                        </div>
                      </div>
                      <!-- .col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.info-boxes-inner -->

                </div>
           </div>

            </div>

            <div class="row">
              <!-- ============================================== SIDEBAR ============================================== -->
              <div class="col-xs-12 col-sm-12 col-md-3 sidebar" style="padding-left: 0;">



                <!-- ============================================== HOT DEALS ============================================== -->
                <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                  <h3 class="section-title">hot deals</h3>
                  <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                    @foreach ($hotDeals as $hotDeal)
                    <div class="item">
                      <div class="products">
                        <div class="hot-deal-wrapper">
                          <div class="image"> <img src="{{ asset('images/product/'. $hotDeal->product_image) }}" alt=""> </div>
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
                <div style="margin-bottom: 30px;" class="home-banner hidden-sm hidden-xs"> <img src="{{ asset('images/setting/' .setting()->banner6) }}" alt="Image"> </div>

                <!-- ============================================== SPECIAL OFFER ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                  <h3 class="section-title">Special Offer</h3>
                  <div class="sidebar-widget-body outer-top-xs">
                    <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                      @foreach ($specialOffers as $chunkSpecialOffers)
                        <div class="item">
                        <div class="products special-product">
                            @foreach ($chunkSpecialOffers as $SpecialOffer)
                          <div class="product">
                            <div class="product-micro">
                              <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                  <div class="product-image">
                                    <div class="image"> <a href="{{ route('product.details', $SpecialOffer->product_slug) }}"> <img src="{{ asset('images/product/'. $SpecialOffer->product_image) }}" alt=""> </a> </div>
                                    <!-- /.image -->

                                  </div>
                                  <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-xs-7">
                                  <div class="product-info">
                                    <h3 class="name"><a href="{{ route('product.details', $SpecialOffer->product_slug) }}">{{ $SpecialOffer->product_title }}</a></h3>

                                    <?php
                                    $count = $SpecialOffer->reviews()->count();
                                    if($SpecialOffer->reviews->count() > 0){
                                        $total = 0;
                                        foreach($SpecialOffer->reviews as $review){
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
                                    <div class="product-price"> <span class="price"> {{ price_format($SpecialOffer->regular_price) }} </span> </div>
                                    <!-- /.product-price -->

                                  </div>
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.product-micro-row -->
                            </div>
                            <!-- /.product-micro -->

                          </div>
                            @endforeach
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                <div style="margin-bottom: 30px;"  class="home-banner hidden-sm hidden-xs"> <img src="{{ asset('images/setting/' .setting()->banner7) }}" alt="Image"> </div>

                <!-- ============================================== SPECIAL DEALS ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                  <h3 class="section-title">Special Deals</h3>
                  <div class="sidebar-widget-body outer-top-xs">
                    <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            @foreach ($specialDeals as $chunkSpecialDeals)
                            <div class="item">
                            <div class="products special-product">
                                @foreach ($chunkSpecialDeals as $specialDeal)
                              <div class="product">
                                <div class="product-micro">
                                  <div class="row product-micro-row">
                                    <div class="col col-xs-5">
                                      <div class="product-image">
                                        <div class="image"> <a href="{{ route('product.details', $specialDeal->product_slug) }}"> <img src="{{ asset('images/product/'. $specialDeal->product_image) }}" alt=""> </a> </div>
                                        <!-- /.image -->

                                      </div>
                                      <!-- /.product-image -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col col-xs-7">
                                      <div class="product-info">
                                        <h3 class="name"><a href="{{ route('product.details', $specialDeal->product_slug) }}">{{ $specialDeal->product_title }}</a></h3>

                                        <?php
                                        $count = $specialDeal->reviews()->count();
                                        if($specialDeal->reviews->count() > 0){
                                            $total = 0;
                                            foreach($specialDeal->reviews as $review){
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
                                        <div class="product-price"> <span class="price"> {{ price_format($specialDeal->regular_price) }} </span> </div>
                                        <!-- /.product-price -->

                                      </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.product-micro-row -->
                                </div>
                                <!-- /.product-micro -->

                              </div>
                                @endforeach
                            </div>
                          </div>
                          @endforeach
                    </div>
                  </div>
                  <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                <div class="home-banner hidden-sm hidden-xs"> <img src="{{ asset('images/setting/' .setting()->banner8) }}" alt="Image"> </div>

                <!-- ============================================== Testimonials============================================== -->
                <div class="sidebar-widget  wow fadeInUp outer-top-vs hidden-sm hidden-xs">
                  <div id="advertisement" class="advertisement">

                        @foreach ($testimonials as $testimonial)
                        <div class="item">
                            <div class="avatar"><img src="{{ asset('images/testimonial/'. $testimonial->avatar) }}" alt="Image"></div>
                            <div class="testimonials"><em>"</em> {!! $testimonial->opinion !!}<em>"</em></div>
                            <div class="clients_author">{{ $testimonial->name }} <span>{{ $testimonial->designation }}</span> </div>
                            <!-- /.container-fluid -->
                        </div>
                        @endforeach

                  </div>
                  <!-- /.owl-carousel -->
                </div>

                <!-- ============================================== Testimonials: END ============================================== -->

                <div class="home-banner hidden-sm hidden-xs"> <img src="{{ asset('images/setting/' .setting()->banner9) }}" alt="Image"> </div>
                <div class="home-banner hidden-sm hidden-xs"> <img class="abc" src="{{ asset('images/setting/' .setting()->banner10) }}" alt="Image"> </div>

              </div>
              <!-- /.sidemenu-holder -->
              <!-- ============================================== SIDEBAR : END ============================================== -->

              <!-- ============================================== CONTENT ============================================== -->
              <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder" style="padding-right: 0;">
                <!-- ========================================== SECTION – HERO ========================================= -->



                <!-- ========================================= SECTION – HERO : END ========================================= -->

                <!-- ============================================== wide-banners ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                          <div class="col-md-7 col-sm-6">
                            <div class="wide-banner cnt-strip">
                              <div class="image"> <img style="min-width: 100%;" class="img-responsive" src="{{ asset('images/setting/' .setting()->banner1) }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                          </div>
                          <!-- /.col -->
                          <div class="col-md-5 col-sm-6">
                            <div class="wide-banner cnt-strip">
                              <div class="image"> <img style="min-width: 100%;" class="img-responsive" src="{{ asset('images/setting/' .setting()->banner2) }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ============================================== wide-banners end ============================================== -->

                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

                <!-- ============================================== NEW PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                  <h3 class="section-title">New products <span style="float: right; padding-right: 60px;"><a href="{{ route('new.product') }}">All</a></span></h3>
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($newProducts as $chunkNewProducts)

                    <div class="item item-carousel">
                      @foreach ($chunkNewProducts as $newProduct)
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> <a href="{{ route('product.details', $newProduct->product_slug) }}"><img  src="{{ asset('images/product/'. $newProduct->product_image) }}"alt=""></a> </div>
                            <!-- /.image -->
                            @if ($newProduct->discount == 1)
                            <div class="tag sale"><span>sale</span></div>
                            @elseif($newProduct->hot_product == 1 && $newProduct->discount != 1)
                            <div class="tag hot"><span>hot</span></div>
                           @else
                           <div class="tag new"><span>new</span></div>
                            @endif
                          </div>
                          <!-- /.product-image -->

                          <div class="product-info text-left">
                            <h3 class="name"><a href="{{ route('product.details', $newProduct->product_slug) }}">{{ $newProduct->product_title }}</a></h3>
                            <?php
                            $count = $newProduct->reviews()->count();
                            if($newProduct->reviews->count() > 0){
                                $total = 0;
                                foreach($newProduct->reviews as $review){
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
                            {{-- <div class="rating rateit-small"></div> --}}

                            <div class="description"></div>
                            @if ($newProduct->discount)
                            <div class="product-price"> <span class="price"> {{ price_format($newProduct->regular_price) }} </span> <span class="price-before-discount">{{ price_format($newProduct->sale_price) }}</span> </div>
                            @else
                            <div class="product-price"> <span class="price"> {{ price_format($newProduct->regular_price) }} </span></div>
                            @endif
                            <!-- /.product-price -->

                          </div>
                          <!-- /.product-info -->
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    {{-- <input type="hidden" class="qty" value="1"> --}}
                                  <button class="btn btn-primary icon atc" name="{{ $newProduct->id }}" type="button" > <i class="fa fa-shopping-cart"></i> </button>
                                  {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}
                                </li>
                                <button class="btn btn-primary cart-btn atc" name="{{ $newProduct->id }}" type="button">Add to cart</button>
                               <li class="lnk wishlist"> <a class="add-to-cart atc pointer" name="{{ $newProduct->id }}" title="Add To Cart">Add to cart </a> </li>
                                {{-- <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li> --}}
                              </ul>
                            </div>
                            <!-- /.action -->
                          </div>
                          <!-- /.cart -->
                        </div>
                        <!-- /.product -->

                      </div>
                      @endforeach
                    </div>
                    @endforeach

                  </div>
                  <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== NEW PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                  <h3 class="section-title">Featured products <span class="fpall" style="float: right; padding-right: 70px;"><a href="{{ route('featured.product') }}">All</a></span></h3>
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($newProducts as $chunkFeaturedProducts)
                    <div class="item item-carousel">
                        @foreach ($chunkFeaturedProducts as $featuredProduct)
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> <a href="{{ route('product.details', $featuredProduct->product_slug) }}"><img  src="{{ asset('images/product/'. $featuredProduct->product_image) }}"alt=""></a> </div>
                            <!-- /.image -->

                            @if ($featuredProduct->discount == 1)
                            <div class="tag sale"><span>sale</span></div>
                            @elseif($featuredProduct->hot_product == 1 && $featuredProduct->discount != 1)
                            <div class="tag hot"><span>hot</span></div>
                           @else
                           <div class="tag new"><span>new</span></div>
                            @endif
                          </div>
                          <!-- /.product-image -->

                          <div class="product-info text-left">
                            <h3 class="name"><a href="{{ route('product.details', $featuredProduct->product_slug) }}">{{ $featuredProduct->product_title }}</a></h3>

                            <?php
                            $count = $featuredProduct->reviews()->count();
                            if($featuredProduct->reviews->count() > 0){
                                $total = 0;
                                foreach($featuredProduct->reviews as $review){
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
                            @if ($newProduct->discount)
                            <div class="product-price"> <span class="price"> {{ price_format($featuredProduct->regular_price) }} </span> <span class="price-before-discount">{{ price_format($featuredProduct->sale_price) }}</span> </div>
                            @else
                            <div class="product-price"> <span class="price"> {{ price_format($featuredProduct->regular_price) }} </span></div>
                            @endif
                            <!-- /.product-price -->

                          </div>
                          <!-- /.product-info -->
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon atc" name="{{ $featuredProduct->id }}" type="button" > <i class="fa fa-shopping-cart"></i> </button>
                                        {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}
                                </li>
                                <li class="lnk wishlist"> <a class="add-to-cart atc pointer" name="{{ $featuredProduct->id }}" title="Add To Cart">Add to cart </a> </li>
                                {{-- <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li> --}}
                              </ul>
                            </div>
                            <!-- /.action -->
                          </div>
                          <!-- /.cart -->
                        </div>
                        <!-- /.product -->

                      </div>
                      @endforeach

                    </div>
                    @endforeach
                    <!-- /.item -->

                  </div>
                  <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                <!-- ============================================== Category PRODUCTS ============================================== -->
                <style>

                .cat-item{
                    height: 148.5px;
                    float: left;
                    padding: 10px;
                    border-bottom: 1px solid #e2e2e2;
                    border-right: 1px solid #e2e2e2;
                }
                .cat-item:hover{
                box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
                }
                .cat-img img{
                    margin: 0 auto;
                }
                .cat-name p{
                    text-align: center;
                    padding-top: 10px;
                }
                </style>

                <!-- ============================================== Categories ============================================== -->
                <section class="section wow fadeInUp new-arriavls" style="margin-bottom: 40px;">
                    <h3 class="section-title">Categories <span style="float: right; padding-right: 20px;"><a href="#">All</a></span></h3>
                    <div class="outer-top-xs" style="padding-bottom: 40px;">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @foreach ($categories as $category)
                                <div class="col-md-2 col-sm-3 col-xs-4 cat-item">
                                    <div class="cat-img">
                                        <a href="{{ route('category.product', $category->id) }}"><img class="img-responsive" width="80px" src="{{ asset('images/category/' .$category->category_image) }}"></a>
                                    </div>
                                    <div class="cat-name">
                                        <p><a href="{{ route('category.product', $category->id) }}">{{ $category->category_name }}</a></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                    <!-- /.section -->
                <!-- ============================================== Categories : END ============================================== -->

                    <!-- ============================================== wide-banners ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="wide-banner cnt-strip">
                              <div class="image"> <img style="min-width: 100%;" class="img-responsive" src="{{ asset('images/setting/' .setting()->banner3) }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                          </div>
                          <!-- /.col -->
                          <div class="col-md-6 col-sm-6">
                            <div class="wide-banner cnt-strip">
                              <div class="image"> <img style="min-width: 100%;" class="img-responsive" src="{{ asset('images/setting/' .setting()->banner4) }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ============================================== wide-banners end ============================================== -->


                <!-- ============================================== BEST SELLER ============================================== -->

                <div class="best-deal wow fadeInUp outer-bottom-xs">
                  <h3 class="section-title">Best seller <span style="float: right; padding-right: 70px;"><a href="{{ route('best.saller.product') }}">All</a></span></h3>
                  <div class="sidebar-widget-body outer-top-xs">
                    <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">

                        @foreach ($newProducts as $chunkBestproducts)
                            <div class="item">
                                <div class="products best-product">
                                    @foreach ( $chunkBestproducts as $bestproduct)

                                  <div class="product">
                                    <div class="product-micro">
                                      <div class="row product-micro-row">
                                        <div class="col col-xs-5">
                                          <div class="product-image">
                                            <div class="image"> <a href="{{ route('product.details', $bestproduct->product_slug) }}"> <img src="{{ asset('images/product/'. $bestproduct->product_image) }}" alt=""> </a> </div>
                                            <!-- /.image -->

                                          </div>
                                          <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col2 col-xs-7">
                                          <div class="product-info">
                                            <h3 class="name"><a href="{{ route('product.details', $bestproduct->product_slug) }}">{{ $bestproduct->product_title }}</a></h3>

                            <?php
                            $count = $bestproduct->reviews()->count();
                            if($bestproduct->reviews->count() > 0){
                                $total = 0;
                                foreach($bestproduct->reviews as $review){
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

                                            <div class="product-price"> <span class="price"> {{ price_format($bestproduct->regular_price) }} </span> </div>
                                            <!-- /.product-price -->

                                          </div>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                  </div>
                                  @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                  </div>
                  <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->


                <!-- ============================================== NEW arriavls PRODUCTS ============================================== -->
                <section class="section wow fadeInUp new-arriavls">
                  <h3 class="section-title">New Arrivals <span style="float: right; padding-right: 70px;"><a href="{{ route('new.arrival.product') }}">All</a></span></h3>
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($newProducts as $chunkNewArrivalProducts)
                    <div class="item item-carousel">
                        @foreach ($chunkNewArrivalProducts as $NewArrivalProduct)
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> <a href="{{ route('product.details', $NewArrivalProduct->product_slug) }}"><img  src="{{ asset('/images/product/'. $NewArrivalProduct->product_image) }}"alt=""></a> </div>
                            <!-- /.image -->

                            @if ($NewArrivalProduct->discount == 1)
                            <div class="tag sale"><span>sale</span></div>
                            @elseif($NewArrivalProduct->hot_product == 1 && $NewArrivalProduct->discount != 1)
                            <div class="tag hot"><span>hot</span></div>
                           @else
                           <div class="tag new"><span>new</span></div>
                            @endif
                          </div>
                          <!-- /.product-image -->

                          <div class="product-info text-left">
                            <h3 class="name"><a href="{{ route('product.details', $NewArrivalProduct->product_slug) }}">{{ $NewArrivalProduct->product_title }}</a></h3>

                            <?php
                            $count = $NewArrivalProduct->reviews()->count();
                            if($NewArrivalProduct->reviews->count() > 0){
                                $total = 0;
                                foreach($NewArrivalProduct->reviews as $review){
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
                            @if ($newProduct->discount)
                            <div class="product-price"> <span class="price"> {{ price_format($NewArrivalProduct->regular_price) }} </span> <span class="price-before-discount">{{ price_format($NewArrivalProduct->sale_price) }}</span> </div>
                            @else
                            <div class="product-price"> <span class="price"> {{ price_format($NewArrivalProduct->regular_price) }} </span></div>
                            @endif
                            <!-- /.product-price -->

                          </div>
                          <!-- /.product-info -->
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon atc" name="{{ $NewArrivalProduct->id }}" type="button" > <i class="fa fa-shopping-cart"></i> </button>
                                        {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}
                                </li>
                                <li class="lnk wishlist"> <a class="add-to-cart atc pointer" name="{{ $NewArrivalProduct->id }}" title="Add To Cart">Add to cart </a> </li>
                                {{-- <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li> --}}
                              </ul>
                            </div>
                            <!-- /.action -->
                          </div>
                          <!-- /.cart -->
                        </div>
                        <!-- /.product -->

                      </div>
                        @endforeach
                    </div>
                   @endforeach
                  </div>
                  <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== NEW arriavls PRODUCTS : END ============================================== -->

              </div>
              <!-- /.homebanner-holder -->
              <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <div class="row">
                 <!-- ============================================== Testimonials============================================== -->
                 <div class="com-sm-12 col-xs-12 sidebar">
                    <div class="sidebar-widget  wow fadeInUp outer-top-vs hidden-lg hidden-md">
                        <div id="advertise" class="advertisement">
                        @foreach ($testimonials as $testimonial)
                        <div class="item">
                            <div class="avatar"><img src="{{ asset('images/testimonial/'. $testimonial->avatar) }}" alt="Image"></div>
                            <div class="testimonials"><em>"</em> {!! $testimonial->opinion !!}<em>"</em></div>
                            <div class="clients_author">{{ $testimonial->name }} <span>{{ $testimonial->designation }}</span> </div>
                            <!-- /.container-fluid -->
                        </div>
                        @endforeach

                        </div>
                        <!-- /.owl-carousel -->
                    </div>
                </div>
                <!-- ============================================== Testimonials: END ============================================== -->
            </div>
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">
              <div class="logo-slider-inner">
                <div style="height: 100px;" id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                       @foreach ($clients as $client)



                        <div class="item m-t-15"> <a href="#" class="image"> <img width="150" data-echo="{{ asset('images/client/'. $client->image) }}" src="{{ asset('assets/frontend/images/blank.gif') }}" alt=""> </a> </div>
                        @endforeach



                </div>
                <!-- /.owl-carousel #logo-slider -->
              </div>
              <!-- /.logo-slider-inner -->

            </div>
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
          </div>
          <!-- /.container -->
        </div>
        <!-- /#top-banner-and-menu -->
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(document).ready(function () {
            $(".atc").click(function (e) {
                e.preventDefault();
                var product_id = $(this).attr("name");
                // var product_qty = $(".qty").val();
                //alert(product_qty);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        data: {product_id: product_id},
                        url: "{{ route('cart.store') }}",
                        success: function(data){
                         //alert(data);
                         //$("#items").html(data);
                        Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data,
                        //title: 'Product Added to cart &nbsp; <i class="fa fa-check-circle fa-lg"></i>',
                        showConfirmButton: false,
                        timer: 2000,
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
