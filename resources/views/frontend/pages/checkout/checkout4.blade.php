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
                        <li class="active"><a href="{{ route('cart') }}">Cart</a></li>
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
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::instance('shopping')->content() as $key => $item)
                        <tr>
                            <td class="image" data-title="No"><img src="{{ $item->model->photo }}" alt="#"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="#"></a></p>{{ $item->name }}
                                <p class="product-des">{{ $item->model->summary }}</p>
                            </td>
                            <td class="price" data-title="Price"><span>${{ $item->price }} </span></td>
                            <td class="qty" data-title="Qty"><!-- Input Order -->
                                {{ $item->qty }}
                            </td>
                            <td class="total-amount" data-title="Total"><span>${{ $item->subtotal() }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                            @if (Cart::count() < 1)
                                <h4 class="text-warning pb-4 text-center">you havn't added any item </h4>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span>${{ Cart::instance('shopping')->subtotal() }}</span></li>
                                    <li>Tax<span>${{ Cart::instance('shopping')->tax() }}</span></li>
                                    <li>Shipping<span>${{ $shipping->delivery_charge }}</span></li>
                                    @if(session()->has('coupon'))
                                       @if (Cart::count() > 0)
                                       <li>Total Amount<span>${{ floatval(preg_replace('/[^\d. ]/', '',  Cart::instance('shopping')->total()))+ $shipping->delivery_charge }}</span></li>
                                       <li>Discount({{ session('coupon')['value'] }} $/%)<span>${{ session('coupon')['discount'] }}</span></li>
                                       <li class="last">You Pay<span>${{  session('coupon')['discountTotal'] + $shipping->delivery_charge }}</span></li>
                                       @else
                                       <li class="last">You Pay<span>${{ 0.00 }}</span></li>
                                       @endif
                                    @else
                                    <li class="last">You Pay<span>${{ floatval(preg_replace('/[^\d. ]/', '', Cart::instance('shopping')->total()))+ $shipping->delivery_charge }}</span></li>
                                    @endif
                                </ul>
                                <div class="button5">
                                    <form action="{{ route('checkout.store') }}" method="POST">
                                        @if(Session::has('coupon'))
                                            <input type="number" name="total_amount" value="{{ session('coupon')['discountTotal']+$shipping->delivery_charge }}" hidden>
                                        @else
                                            <input type="number" name="total_amount" value="{{ floatval(preg_replace('/[^\d. ]/', '', Cart::instance('shopping')->total()))+ $shipping->delivery_charge }}" hidden>
                                        @endif
                                        <input type="number" name="sub_total" value="{{ floatval(preg_replace('/[^\d. ]/', '', Cart::instance('shopping')->subtotal())) }}" hidden>
                                    @csrf
                                        <button type="submit" class="btn">Confirm</button>
                                    </form>
                                    <a href="{{ route('checkout') }}" class="btn">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->
@endsection
