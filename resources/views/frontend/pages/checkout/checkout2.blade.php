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

<!-- Shopping Cart -->
<div class="shopping-cart section" id="cart-page-ajax-loader">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('frontend.layouts.notification')
                <!-- Shopping Summery -->
                <form action="{{ route('checkout.payment') }}" method="POST">
                    @csrf
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th class="text-center">#</th>
                            <th class="text-center">Shipping Address</th>
                            <th class="text-center">Delivery Time</th>
                            <th class="text-center">Charge</th>
                            <th class="text-center">Choose</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shippings as $key => $item)
                        <tr>
                            <td class="text-center"><span>{{ $loop->iteration }} </span></td>
                            <td class="text-center"><span>${{ $item->shipping_address }} </span></td>
                            <td class="text-center"><span>${{ $item->delivery_time }} </span></td>
                            <td class="text-center"><span>${{ $item->delivery_charge }} </span></td>
                            <td class="text-center"><span><input type="radio" name="delivery_type" value="{{ $item->id }}" required> </span></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
                <div class="single-widget get-button">
                    <div class="content">
                        <div class="button">
                            <button type="submit" class="btn float-right">proceed to payment</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->
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

