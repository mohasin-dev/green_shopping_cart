@extends('frontend.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Order Confirmation</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="container">
    <div class="jumbotron mt-3" style="background-color: #e0d8d8;">
      <h2 style="text-align: center; color: green">Congratulations !!</h2>
      <h3 style="text-align: center; color: #e40046">Thanks For Your Order !!</h3>
      <p style="text-align: center" class="mb-1">Your order has been taken. We will send you a confirmation mail with your order invoice.</p>
      <p style="text-align: center">Thank you for shopping at Green Hat Bazar !!</p>
    </div>
</div>
@endsection
