@extends('frontend.app')

@section('title', 'Shopping Cart')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/handleCounter.css') }}">
    <style>
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
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Subtotal</th>
					<th class="cart-total last-item">Grandtotal</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
			</tfoot>
			<tbody>
                @if (Cart::count() > 0)
                <h4 style="font-weight: bold; padding-left: 20px">{{ Cart::count() }} item(s) in Shopping Cart</h4>
                @foreach (Cart::content() as $item)
                <tr>
					<td class="romove-item"><a class="rfc" id="{{ $item->rowId }}" href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="{{ route('product.details',  $item->model->product_slug) }}">
						    <img src="{{ asset('images/product/'. $item->model->product_image) }}" alt="">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="{{ route('product.details',  $item->model->product_slug) }}">{{ $item->model->product_title }}</a></h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="rating rateit-small"></div>
							</div>
							<div class="col-sm-8">
								<div class="reviews">
									(06 Reviews)
								</div>
							</div>
						</div><!-- /.row -->
						{{-- <div class="cart-product-info">
							<span class="product-color">COLOR:<span>Blue</span></span>
						</div> --}}
					</td>
					<td class="cart-product-quantity">
                        {{-- <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->qty }}">
                            @for ($i = 1; $i < 5 + 1 ; $i++)
                                <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select> --}}
                        <div class="handle-counter" id="handleCounter">
                            <button class="counter-minus btn btn-primary">-</button>
                            <input  class="quantity" type="text" id="{{ $item->rowId }}" value="{{ $item->qty }}">
                            <button class="counter-plus btn btn-primary">+</button>
                        </div>
                    </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price">{{ price_format($item->price) }}</span></td>
					<td class="cart-product-grand-total"><span class="cart-grand-total-price">{{ price_format($item->subtotal) }}</span></td>
                </tr>
                @endforeach
                @else
                <h4 style="font-weight: bold; padding-left: 44px">No items in Cart!</h4>
                @endif
			</tbody><!-- /tbody -->
		</table><!-- /table -->
	</div>
</div><!-- /.shopping-cart-table -->
{{-- <div class="col-md-2 col-sm-12 estimate-ship-tax">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Estimate shipping and tax</span>
					<p>Enter your destination to get shipping and tax.</p>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<label class="info-title control-label">Country <span>*</span></label>
							<select class="form-control unicase-form-control selectpicker">
								<option>--Select options--</option>
								<option>India</option>
								<option>SriLanka</option>
								<option>united kingdom</option>
								<option>saudi arabia</option>
								<option>united arab emirates</option>
							</select>
						</div>
						<div class="form-group">
							<label class="info-title control-label">State/Province <span>*</span></label>
							<select class="form-control unicase-form-control selectpicker">
								<option>--Select options--</option>
								<option>TamilNadu</option>
								<option>Kerala</option>
								<option>Andhra Pradesh</option>
								<option>Karnataka</option>
								<option>Madhya Pradesh</option>
							</select>
						</div>
						<div class="form-group">
							<label class="info-title control-label">Zip/Postal Code</label>
							<input type="text" class="form-control unicase-form-control text-input" placeholder="">
						</div>
						<div class="pull-right">
							<button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
						</div>
					</td>
				</tr>
		</tbody>
	</table>
</div><!-- /.estimate-ship-tax --> --}}
<div class="col-md-3 col-sm-12 estimate-ship-tax">
    <div class="shopping-cart-btn" style="margin-top: 80px;">
        <span class="" >
            <a href="{{ route('home') }}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
            {{-- <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> --}}
        </span>
    </div><!-- /.shopping-cart-btn -->
</div>
<div class="col-md-4 col-sm-12 estimate-ship-tax">
    @if (!session()->has('coupon'))
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
                    <td>
                        <form action="{{ route('cart.coupon') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="coupon_code" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
                            </div>
                            <div class="clearfix pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
                            </div>
                        </form>
					</td>
				</tr>
		</tbody><!-- /tbody -->
    </table><!-- /table -->
    @endif
</div><!-- /.estimate-ship-tax -->

<div class="col-md-5 col-sm-12 cart-shopping-total">
	<table class="table">
		<thead>
			<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">{{ price_format(Cart::subtotal()) }}</span>
                    </div>

                    @if (session()->has('coupon'))
					<div class="cart-sub-total" style="border-bottom: 1px solid #ccc; padding-bottom: 7px;">
                        Discount ({{ session()->get('coupon')['name'] }})
                        <form action="{{ route('cart.coupon.destroy') }}" method="POST" style="display: inline;">
                            @csrf
                            <button style="font-size: 12px;" type="submit">Remove</button>
                        </form>
                        <span class="inner-left-md">- {{ price_format(session()->get('coupon')['discount']) }}</span>
                    </div>
                    <div class="cart-sub-total">
                        @php
                           $newSubtotal = Cart::subtotal() - session()->get('coupon')['discount'];
                        @endphp
                        New Subtotal<span class="inner-left-md">{{ price_format($newSubtotal) }}</span>
                    </div>
                    @endif
                    <div class="cart-sub-total">
                        Shipping<span class="inner-left-md">+ {{ price_format(100) }}</span>
                    </div>

					<div class="cart-grand-total">
                        @if (session()->has('coupon'))
                        @php
                        $newTotal = $newSubtotal + 100;
                        @endphp
                        Grand Total<span class="inner-left-md">{{ price_format($newTotal) }}</span>
                        @else
                        @php
                        $total = Cart::total() + 100;
                        @endphp
                        Grand Total<span class="inner-left-md">{{ price_format($total) }}</span>
                        @endif
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
                            @auth
                            <a href="{{ route('checkout') }}" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
                            @else
							<a href="{{ route('checkout.login') }}" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
                            @endauth
                            {{-- <span class="">Checkout with multiples address!</span> --}}
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		</div> <!-- /.body-content -->

@endsection

@push('js')
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script src="{{ asset('assets/frontend/js/handleCounter.js') }}"></script>
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
                        //title: data + '&nbsp; <i class="fa fa-check-circle fa-lg"></i>',
                        showConfirmButton: false,
                        timer: 1500,
                        });
                        location.reload();
                        // setTimeout(function(){// wait for 5 secs(2)
                        //     location.reload(); // then reload the page.(3)
                        // }, 1500);
                        }
                    });
                });


            });
    </script>
    <script>
    $(document).ready(function () {


                var product_qty = $(this).val();
                // alert(rowId);
                // alert(product_qty);

                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });
                    // $.ajax({
                    //     type: "POST",
                    //     data: {rowId: rowId, product_qty: product_qty},
                    //     url: "{{ route('cart.update') }}",
                    //     success: function(data){
                    //     Swal.fire({
                    //     position: 'top-end',
                    //     type: 'success',
                    //     title: data,
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    //     });
                    //     setTimeout(function(){
                    //     window.location.reload(1);
                    //     }, 1000);
                    //     //location.reload();
                    //     },
                    //     error: function () {
                    //     Swal.fire({
                    //     position: 'top-end',
                    //     type: 'error',
                    //     title: 'Quantity must be between 1 & 5',
                    //     showConfirmButton: false,
                    //     timer: 3000,
                    //     });
                    //     setTimeout(function(){
                    //     window.location.reload(1);
                    //     }, 3000);
                    //     }
                    // });
            });
    </script>

<script>
        $(function ($) {
            var options = {
                minimum: 1,
                maximize: 10,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#handleCounter').handleCounter(options)
            $('#handleCounter2').handleCounter(options)
			$('#handleCounter3').handleCounter({maximize: 100})
        })
        function valChanged(d) {
//            console.log(d)
        }
    </script>
@endpush

