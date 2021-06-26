@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
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
            @include('frontend.layouts.notification')
                <form class="form" method="POST" action="{{route('checkout.shipping')}}">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="checkout-form">
                                <h2>Make Your Checkout Here</h2>
                                <!-- Form -->
                                <div class="row">
                                    @php
                                        $name = explode(' ',Auth::user()->full_name)
                                    @endphp
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>First Name<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="" value="{{ $name[0] }}" required>
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Last Name<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="" value="{{ $name[1] }}" required>
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email Address<span>*</span></label>
                                            <input type="email" name="email" placeholder="" value="{{ Auth::user()->email }}" required>
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Phone Number <span>*</span></label>
                                            <input type="number" name="phone" placeholder=""  value ="{{ Auth::user()->phone }}" required>
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Note <span>*</span></label>
                                            <textarea name="note" id="" cols="30" rows="10" required >{{ old('note') }}</textarea>
                                            @error('note')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="single-widget get-button">
                                        <div class="content">
                                            <div class="button">
                                                <button type="submit" class="btn">proceed to shipping</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-4">
                            <h2 >Billing Address</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Country<span>*</span></label>
                                            <input type="text" id="country" name="country" placeholder="" required value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->country : old('country')}}">
                                            @error('country')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Address<span>*</span></label>
                                            <input type="text" id="address" name="address" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->address : old('address')}}">
                                            @error('address')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>City<span>*</span></label>
                                            <input type="text" id="city" name="city" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->city : old('city')}}">
                                            @error('city')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>State<span>*</span></label>
                                            <input type="text" id="state" name="state" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->state : old('state')}}">
                                            @error('state')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Postal Code<span>*</span></label>
                                            <input type="text" id="postcode" name="postcode" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->postcode : old('postcode')}}">
                                            @error('postcode')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <form-group>
                                    <input name="payment_method"  type="checkbox" id="customChecked"> <label class="ml-3 font-weight-bold">Shipping Address</label>

                                </form-group>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Country<span>*</span></label>
                                            <input type="text" id="scountry" name="scountry" placeholder="" required value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->scountry : old('scountry')}}">
                                            @error('scountry')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>address<span>*</span></label>
                                            <input type="text" name="saddress" id="saddress" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->saddress : old('saddress')}}">
                                            @error('address')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>City<span>*</span></label>
                                            <input type="text" id="scity" name="scity" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->scity : old('scity')}}">
                                            @error('scity')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>State<span>*</span></label>
                                            <input type="text" id="sstate" name="sstate" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->sstate : old('sstate')}}">
                                            @error('sstate')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" id="spostcode" name="spostcode" placeholder="" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->spostcode : old('spostcode')}}">
                                            @error('spostcode')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->

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

    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="EMAIL" placeholder="Your email address" required="" type="email">
                                <button class="btn">Subscribe</button>
                            </form>
                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->
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
@push('scripts')
    <script>
        $('#customChecked').on('change',function(e){
            e.preventDefault();
            if(this.checked){
                $('#scountry').val($('#country').val())
                $('#saddress').val($('#address').val())
                $('#scity').val($('#city').val())
                $('#sstate').val($('#state').val())
                $('#spostcode').val($('#postcode').val())
            }else{
                $('#scountry').val('')
                $('#saddress').val('')
                $('#scity').val('')
                $('#sstate').val('')
                $('#spostcode').val('')
            }
        });
    </script>

	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>

@endpush
