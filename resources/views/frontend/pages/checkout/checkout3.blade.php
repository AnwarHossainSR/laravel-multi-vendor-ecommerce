@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('main-content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="{{ route('checkout') }}">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
            <form class="form" method="POST" action="{{route('checkout.order')}}">
                @csrf
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <div class="checkout-form">
                            <h2>Make Your Payment Here</h2>
                            <!-- Form -->
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>CART  TOTALS</h2>
                                    <div class="content">
                                        <ul>

                                            <li class="order_subtotal" data-price="{{Cart::instance('shopping')->subtotal()}}">Cart Total<span>${{Cart::instance('shopping')->total()}}</span></li>
                                            <li class="order_subtotal">Tax<span>${{Cart::instance('shopping')->tax()}}</span></li>
                                           {{--  <li class="order_subtotal">Shipping<span>${{$shipping->delivery_charge}}</span></li> --}}

                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['discount']}}">You Save<span>${{session('coupon')['discount']}}</span></li>
                                            @endif
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Total<span>${{session('coupon')['discountTotal']}}</span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Total<span>${{ Cart::instance('shopping')->total() }}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Payments</h2>
                                    <div class="content">
                                        <div class="checkbox">
                                            <form-group>
                                                <input name="payment_method"  type="radio" value="cod" required> <label> Cash On Delivery</label><br>
                                                <input name="payment_method"  type="radio" value="paypal" readonly> <label> PayPal</label>
                                            </form-group>

                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Payment Method Widget -->
                                <div class="single-widget payement">
                                    <div class="content">
                                        <img src="{{asset('frontend/img/payment-method.png')}}" alt="#">
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->

                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="checkout-form">
                            <h2>Payment Information</h2>
                            <!-- Form -->
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Card No<span>*</span></label>
                                            <input type="text" id="card_no" name="card_no" placeholder="" required value="{{ old('card_no')}}">
                                            @error('card_no')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Expiration<span>*</span></label>
                                            <input type="date" id="expire" name="expire" placeholder="" required value="{{ old('expire')}}">
                                            @error('expire')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Security Code<span>*</span></label>
                                            <input type="text" id="security_code" name="security_code" placeholder="" required value="{{ old('security_code')}}">
                                            @error('security_code')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div>
                                            <input type="checkbox" id="security_code" required >&nbsp;&nbsp;&nbsp;<span>I have read all term and conditions</span>
                                        </div>
                                    </div>
                                    <!-- Button Widget -->
                                    <div class="single-widget get-button mt-3">
                                        <div class="content">
                                            <div class="button">
                                                <button type="submit" class="btn">Make payment</button>
                                            </div>
                                        </div>
                                    </div>
                                <!--/ End Button Widget -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</section>
<!-- Start Shop Services Area  -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services -->
@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush

