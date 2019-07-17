@extends('frontend.app')

@section('title', 'Upsale Products')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    {{-- <li><a href="#">Clothing</a></li> --}}
                    <li class='active'>Upsale Products</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row'>
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

                                                <div class="col-sm-12 col-md-3">
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
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div class="search-result-container ">
                <div id="myTabContent" class="tab-content category-list">
                    <div class="tab-pane active " id="grid-container">
                    <div class="category-product">
                        <div class="row">
                        @foreach ($upsaleProducts as $upsaleProduct)
                        <div class="col-sm-6 col-md-3 wow fadeInUp">
                            <div class="products">

                            <div class="product">
                                <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('images/product/'. $upsaleProduct->product_image) }}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag new"><span>new</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">{{ $upsaleProduct->product_title }}</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> {{ price_format($upsaleProduct->regular_price) }} </span> <span class="price-before-discount">{{ price_format($upsaleProduct->sale_price) }}</span> </div>
                                <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon atc" name="{{ $upsaleProduct->id }}" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                        {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart atc pointer" name="{{ $upsaleProduct->id }}" title="Add To Cart">Add to cart </a> </li>
                                    {{-- <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li> --}}
                                    </ul>
                                </div>
                                <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>

                            <!-- /.product -->
                            </div>
                            <!-- /.products -->
                        </div>
                        @endforeach
                        <!-- /.item -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.category-product -->

                    </div>
                    <!-- /.tab-pane -->


                </div>
                <!-- /.tab-content -->
                <div style="text-align: center;" class="clearfix filters-container">
                    {{ $upsaleProducts->links() }}
                    {{-- {{ $upsaleProducts->onEachSide(5)->links() }} --}}
                </div>
                <!-- /.filters-container -->

                </div><br><br>
                <!-- /.search-result-container -->

            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </div>

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
                         $("#items").html(data);
                        Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Product Added to cart',
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
