@extends('frontend.app')

@section('title', 'Checkout')

@push('css')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


    <!--------------------
This page css
------------------>
<style>
    .spacer {
    margin-top: 50px;
    }
    .order-content {
    border-bottom: 1.2px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 20px;
    }

    .order-total {
    border-bottom: 1.2px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 40px;
    }
    .order-total .left {
        text-align: left;
    }
    .order-total .right {
        text-align: right;
    }
    .mr{
        padding-right: 40px;
    }
    .bb{
        border-bottom: 1px solid #c7003d;
        padding-bottom: 10px;
    }
    .fw-700{
        font-weight: 700;
    }
    .br-0{
        border-radius: 0;
    }

</style>
@endpush

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12 mr">
            <h4 class="bb fw-700">Shipping Address</h4>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Full Name" name="name" value="{{ old('name') }}" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputBirthday">Email</label>
                    <input type="email" class="form-control" id="exampleInputBirthday" placeholder="Eamil" name="email" value="{{ old('email') }}" required="">
                </div>
                <div class="form-group">
                    <label for="exampleMaidenName">Address</label>
                    <textarea class="form-control" id="exampleMaidenName" name="address" placeholder="Address" value="{{ old('address') }}"></textarea>
                </div>
                <div class="from-row">
                    <div class="form-group col-md-6 col-sm-6" style="padding: 0 15px 0 0">
                        <label for="exampleInputEmail">District</label>
                        <select id="district_id" class="form-control district_id" name="district_id" value="{{ old('district_id') }}" required="">
                            {{-- <option value="{{ $key }}" {{ (Input::old("title") == $key ? "selected":"") }}>{{ $val }}</option> --}}
                            <option value="">Select a District</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                            @endforeach

                        </select>
                        {{-- <input type="text" class="form-control" name="emailInput" id="exampleInputEmail" placeholder="Division/City" required> --}}
                    </div>
                    <div class="form-group col-md-6 col-sm-6" style="padding: 0 0 0 15px">
                        <label for="exampleInputEmail">Upazila</label>
                        <select id="upazila_id" class="form-control upazila_id" name="upazila_id" value="{{ old('upazila_id') }}" required="">
                            <option value="">Select a Upazila</option>
                            {{-- @foreach ($upazilas as $upazila)
                            <option value="{{ $upazila->id }}">{{ $upazila->upazila_name }}</option>
                            @endforeach --}}
                        </select>
                        {{-- <input type="text" class="form-control" name="emailInput" id="exampleInputEmail" placeholder="Division/City" required> --}}
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="exampleInputPassword">Zip code/Postal code</label>
                    <input type="text" class="form-control" id="exampleInputPassword" placeholder="Zip code/Postal code" name="passwordInput">
                </div> --}}
                <div class="form-group">
                    <label for="exampleInputPassword">Phone Number</label>
                    <input type="text" class="form-control" id="exampleInputPassword" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required="">
                </div>
                {{-- <div class="checkbox">
                    <label>
                    <input type="checkbox" name="checkboxInput" value="1"> Billing Address & Shipping Address are same?
                    </label>
                </div> --}}
                <br>

            <h4 class="bb fw-700">Payment Details</h4>
                <div class="form-group">
                    <label for="exampleInputName">Payment Method</label>&nbsp;&nbsp;
                    <input type="radio" class="payment_method" id="exampleInputName" name="payment_method" value="1" required="required" @if(old('payment_method')) checked @endif> Cash On Delevery &nbsp;&nbsp;
                    <input type="radio" class="payment_method" id="exampleInputName" name="payment_method" value="2"required="required" @if(old('payment_method')) checked @endif> Bkash&nbsp;&nbsp;
                    <input type="radio" class="payment_method" id="exampleInputName" name="payment_method" value="3" required="required" @if(old('payment_method')) checked @endif> Roket
                </div>
                <div id="Bkash" >
                    <div id="payment_Bkash" class="alert alert-success hidden">
                        <h3>Bkash Payment <img src="{{ asset('assets/frontend/images/bkash.png') }}" width="100" height="60"></h3>
                        <p><strong>Bkash Number :{{ setting()->mobile_number1 }}</strong><br>
                        <strong>Account Type: Personal</strong>
                        </p>
                        <h4>Please send the avobe money to this bkash number & give your tranjction code below there</h4>
                    </div>
                </div>

                <div id="Roket" >
                    <div id="payment_Roket" class="alert alert-success hidden">
                        <h3>Roket Payment <img src="{{ asset('assets/frontend/images/roket.png') }}" width="100" height="60"></h3>
                        <p><strong>Roket Number :{{ setting()->mobile_number1 }}</strong><br>
                        <strong>Account Type: Personal</strong>
                        </p>
                        <h4>Please send the avobe money to this bkash number & give your tranjction code below there</h4>
                    </div>
                </div>

                <div class="form-group row hidden" id="transaction_number">
                <label for="username" class="col-md-4 col-form-label text-md-right">Transaction Number</label>
                    <div class="col-md-6">
                    <input id="transaction_number" type="text" class="form-control" name="transaction_number" value="" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary form-control br-0">Submit</button><br><br>
            </form>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="">
                <h4 class="bb fw-700">Your Order</h4>
                @foreach (Cart::content() as $item)
                <div class="row order-content">
                    <div class="order ">
                        <div class="col-md-3 col-sm-3 col-xs-3"><img src="{{asset('images/product/'.$item->model->product_image)}}" width="80px;" alt=""></div>
                        <div class="col-md-4 col-sm-3 col-xs-3">{{ $item->name }}</div>
                        <div class="col-md-3 col-sm-3 col-xs-3">{{ price_format($item->price) }}</div>
                        <div class="col-md-2 col-sm-3 col-xs-3">{{ $item->qty }}</div>
                    </div>
                </div>
                @endforeach
            </div><br><br>

            <div class="order-total">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 left">
                        <p>Subtotal</p>
                        @if (session()->has('coupon'))
                        <p style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Discount ({{ session()->get('coupon')['name'] }})</p>
                        @php
                        $newSubtotal = Cart::subtotal() - session()->get('coupon')['discount'];
                        @endphp
                        <p>New Subtotal</p>
                        @endif
                        <p>Shipping</p>
                        <strong>Total</strong>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 right">
                        <p>{{price_format(Cart::subtotal())}}</p>
                        @if (session()->has('coupon'))
                        <p style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">- {{ price_format(session()->get('coupon')['discount']) }}</p>
                        <p>{{ price_format($newSubtotal) }}</p>
                        @endif
                        <p>{{price_format(100)}}</p>
                        @if (session()->has('coupon'))
                        @php
                        $newTotal = $newSubtotal + 100;
                        @endphp
                        <strong>{{ price_format($newTotal) }}</strong>
                        @else
                        @php
                        $total = Cart::total() + 100;
                        @endphp
                       <strong>{{ price_format($total) }}</strong>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
            $('#district_id').change(function(){
            var district_id = ($(this).val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                data: {district_id: district_id},
                url: "{{ route('upazila') }}",
                success: function(data){
                $("#upazila_id").html(data);
                }
            });
        });
    })

</Script>

<script>
    $(document).ready(function() {
        $('.district_id').select2();
        $('.upazila_id').select2();
    });
</script>
<script>
$(document).ready(function () {

   $(".payment_method").click(function(){
           var payment_method = $(this).val();
           //alert(payment_method);
           if(payment_method == 1){
            $("#payment_Bkash").addClass('hidden');
            $("#payment_Roket").addClass('hidden');
            $("#transaction_number").addClass('hidden');
           }
           if(payment_method == 2){
            $("#payment_Bkash").removeClass('hidden');
            $("#payment_Roket").addClass('hidden');
            $("#transaction_number").removeClass('hidden');
           }
           if(payment_method == 3){
            $("#payment_Roket").removeClass('hidden');
            $("#payment_Bkash").addClass('hidden');
            $("#transaction_number").removeClass('hidden');
           }

    })
});

</script>
@endpush
