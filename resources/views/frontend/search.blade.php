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
                    {{-- <li><a href="{{ route('category.product', $product->category->id) }}">{{ $product->category->category_name }}</a></li> --}}
                    <li class='active'>{{ $term }}</li>
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
                    </div>
                </div>
                <div class='col-md-9'>
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                        <div class="category-product">
                            <div class="row">
                            @foreach ($search_products as $search_product)
                            <div class="col-sm-6 col-md-3 wow fadeInUp">
                                <div class="products">

                                <div class="product">
                                    <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img  src="{{ asset('images/product/'. $search_product->product_image) }}" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag new"><span>new</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">{{ $search_product->product_title }}</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> {{ price_format($search_product->regular_price) }} </span> <span class="price-before-discount">{{ price_format($search_product->sale_price) }}</span> </div>
                                    <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button class="btn btn-primary icon atc" name="{{ $search_product->id }}" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                            {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}
                                        </li>
                                        <li class="lnk wishlist"> <a class="add-to-cart atc pointer" name="{{ $search_product->id }}" title="Add To Cart">Add to cart </a> </li>
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
                        {{ $search_products->links() }}
                        {{-- {{ $search_products->onEachSide(5)->links() }} --}}
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
