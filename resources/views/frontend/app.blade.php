<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.css') }}">

    <!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
        <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap-select.min.css') }}">

     <!--Toster css-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @stack('css')
    <style>
    .pointer{
        cursor: pointer;
    }
    </style>
</head>
<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">

      <!-- ============================================== TOP MENU ============================================== -->
      <div class="top-bar animate-dropdown">
        <div class="container">
          <div class="header-top-inner">
            <div class="cnt-account">
              <ul class="list-unstyled">
                @auth
                <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                @else
                <li><a href="{{ route('login') }}">My Account</a></li>
                @endauth
                {{-- <li><a href="#">Wishlist</a></li> --}}
                <li><a href="{{ route('cart.index') }}">My Cart</a></li>
                @auth
                <li><a href="{{ route('checkout') }}">Checkout</a></li>
                @else
                <li><a href="{{ route('checkout.login') }}">Checkout</a></li>
                @endauth

                @auth
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                        </form>
                    </li>
                @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @endauth


              </ul>
            </div>
            <!-- /.cnt-account -->

            {{-- <div class="cnt-block">
              <ul class="list-unstyled list-inline">
                <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">USD</a></li>
                    <li><a href="#">INR</a></li>
                    <li><a href="#">GBP</a></li>
                  </ul>
                </li>
                <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">English</a></li>
                    <li><a href="#">French</a></li>
                    <li><a href="#">German</a></li>
                  </ul>
                </li>
              </ul>
              <!-- /.list-unstyled -->
            </div> --}}
            <!-- /.cnt-cart -->
            <div class="offer-text" style="font-weight: bold; font-size:14px;">Helpline: @if(setting()->mobile_number1){{ setting()->mobile_number1 }}@endif</div>
            <div class="clearfix"></div>
          </div>
          <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
      </div>
      <!-- /.header-top -->
      <!-- ============================================== TOP MENU : END ============================================== -->
      <div class="main-header">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
              <!-- ============================================================= LOGO ============================================================= -->
              <div class="logo">
                   <a href="home.html">
                       <a href="{{ route('home') }}" style="color: #fff; font-size: 22px; font-weight: bold">Green Hat Bazar</a>
                       {{-- <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="logo"> --}}
                     </a>
                 </div>
              <!-- /.logo -->
              <!-- ============================================================= LOGO : END ============================================================= --> </div>
            <!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
              <!-- /.contact-row -->
              <!-- ============================================================= SEARCH AREA ============================================================= -->
              <div class="search-area">
                <form>
                  <div class="control-group">
                    {{-- <ul class="categories-filter animate-dropdown">
                      <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" >
                          <li class="menu-header">Computer</li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                        </ul>
                      </li>
                    </ul> --}}
                    <input class="search-field" placeholder="Search here..." />
                    <a class="search-button" href="#" ></a> </div>
                </form>
              </div>
              <!-- /.search-area -->
              <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
            <!-- /.top-search-holder -->

            <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
              <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

              <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                <div class="items-cart-inner">
                  <div class="top-cart">  </div>

                  <div class="total-price-basket">

                    <span class="lbl" id="items">{{ Cart::count() > 0 ?  items()  : 0 }}</span><span class="lbl"> item(s) /</span>

                    {{-- <span class="lbl" id="items">{{ items() }}</span> item(s) / --}}

                       <span class="total-price"> <span class="sign"></span><span class="value">{{ price_format(Cart::total()) }}</span> </span>
                     </div>
                </div>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="cart-item product-summary">
                      <div class="row">
                        @foreach ( contents() as $item)
                        <div class="col-xs-4">
                          <div class="image"> <a href="detail.html"><img src="{{ asset('images/product/'. $item->model->product_image) }}" alt=""></a> </div>
                        </div>
                        <div class="col-xs-7">
                          <h3 class="name"><a href="index8a95.html?page-detail">{{ $item->model->product_title }}</a></h3>
                          <div class="price">{{ price_format($item->model->regular_price) }} * {{ $item->qty }}</div>
                        </div>
                        <div class="col-xs-1 action"> <a class="rfc" id="{{ $item->rowId }}" href="#"><i class="fa fa-trash"></i></a> </div>
                        {{-- <td class="romove-item"><a class="rfc" id="{{ $item->rowId }}" href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td> --}}
                        @endforeach
                    </div>
                    </div>
                    <!-- /.cart-item -->
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix cart-total">
                      <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>{{ price_format(Cart::total()) }}</span> </div>
                      <div class="clearfix"></div>
                      <a href="{{ route('cart.index') }}" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a>
                      @auth
                      <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                      @else
                      <a href="{{ route('checkout.login') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                      @endauth
                    </div>
                    <!-- /.cart-total-->

                  </li>
                </ul>
                <!-- /.dropdown-menu-->
              </div>
              <!-- /.dropdown-cart -->

              <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
            <!-- /.top-cart-row -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.container -->

      </div>
      <!-- /.main-header -->

      <!-- ============================================== NAVBAR ============================================== -->
      <!-- /.header-nav -->
      <!-- ============================================== NAVBAR : END ============================================== -->
    </header>
    <!-- ============================================== HEADER : END ============================================== -->

@yield('content')

    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="module-heading">
                <h4 class="module-title">Contact Us</h4>
              </div>
              <!-- /.module-heading -->

              <div class="module-body">
                <ul class="toggle-footer" style="">
                  <li class="media">
                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                    <div class="media-body">
                        @if(setting()->address1)
                        {{ setting()->address1 }}<br>
                        @endif
                        @if(setting()->address2)
                        {{ setting()->address2 }}</p>
                        @endif
                    </div>
                  </li>
                  <li class="media">
                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                    <div class="media-body">
                    @if(setting()->mobile_number1)
                      {{ setting()->mobile_number1 }}<br>
                    @endif
                    @if(setting()->mobile_number2)
                      {{ setting()->mobile_number2 }}</p>
                    @endif

                    </div>
                  </li>
                  <li class="media">
                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                    <div class="media-body" style="margin-top: -10px">
                        @if(setting()->email1)
                         <span><a href="http://greenhatbazar.com/webmail">{{ setting()->email1 }}</a>
                        @endif
                        @if(setting()->email2)
                        <a style="line-height: 15px;" href="http://greenhatbazar.com/webmail">{{ setting()->email2 }}</a></span>
                        @endif
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.module-body -->
            </div>
            <!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="module-heading">
                <h4 class="module-title">Customer Service</h4>
              </div>
              <!-- /.module-heading -->

              <div class="module-body">
                <ul class='list-unstyled'>
                  <li class="first"><a href="#" title="Contact us">My Account</a></li>
                  <li><a href="#" title="About us">Order History</a></li>
                  <li><a href="#" title="faq">FAQ</a></li>
                  <li><a href="#" title="Popular Searches">Specials</a></li>
                  <li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
                </ul>
              </div>
              <!-- /.module-body -->
            </div>
            <!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="module-heading">
                <h4 class="module-title">Corporation</h4>
              </div>
              <!-- /.module-heading -->

              <div class="module-body">
                <ul class='list-unstyled'>
                  <li class="first"><a title="Your Account" href="#">About us</a></li>
                  <li><a title="Information" href="#">Customer Service</a></li>
                  <li><a title="Addresses" href="#">Company</a></li>
                  <li><a title="Addresses" href="#">Investor Relations</a></li>
                  <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
                </ul>
              </div>
              <!-- /.module-body -->
            </div>
            <!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="module-heading">
                <h4 class="module-title">Why Choose Us</h4>
              </div>
              <!-- /.module-heading -->

              <div class="module-body">
                <ul class='list-unstyled'>
                  <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                  <li><a href="#" title="Blog">Blog</a></li>
                  <li><a href="#" title="Company">Company</a></li>
                  <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                  <li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
                </ul>
              </div>
              <!-- /.module-body -->
            </div>
          </div>
        </div>
      </div>
      <div class="copyright-bar">
        <div class="container">
          <div class="col-xs-12 col-sm-6 no-padding social">
            <ul class="link">
              <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
              <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
              <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
              <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
              <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
              <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
              <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 no-padding">
            <div class="clearfix payment-methods">
              <ul>
                <li><img src="{{ asset('assets/frontend/images/payments/1.png') }}" alt=""></li>
                <li><img src="{{ asset('assets/frontend/images/payments/2.png') }}" alt=""></li>
                <li><img src="{{ asset('assets/frontend/images/payments/3.png') }}" alt=""></li>
                <li><img src="{{ asset('assets/frontend/images/payments/4.png') }}" alt=""></li>
                <li><img src="{{ asset('assets/frontend/images/payments/5.png') }}" alt=""></li>
              </ul>
            </div>
            <!-- /.payment-methods -->
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
            <div>
                <p class="text-center" style="margin-bottom: 5px; color: #fff;">copyright © 2019. Green Hat Bazar | All right reserved </p>
                <p class="text-center" style="margin-bottom: 0px;color: #fff;">Design &amp; Developed By <a style="color: #fff;" href="http://intezie.com" target="_blank">Intezie Limited</a> | Powered By Creativity &amp; Technology</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/frontend/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/echo.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
    <!--toster js-->
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
            @foreach($errors->all() as $error)
                    toastr.error('{{ $error }}','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
            @endforeach
        @endif
    </script>

    <script>
        $(document).ready(function () {
            $(".rfc").click(function (e) {
                e.preventDefault();
                var product_id = $(this).attr("id");
                //alert(product_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        data: {product_id: product_id},
                        url: "{{ route('cart.destroy') }}",
                        success: function(data){
                         //alert(data);
                        Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data,
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

    @stack('js')
    </body>
</html>
