@extends('frontend.layouts.master')
@section('title','E-SHOP || HOME PAGE')
@section('main-content')
<!-- Slider Area -->

@if(count($banners)>0)
    <section id="Gslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
            @endforeach

        </ol>
        <div class="carousel-inner" role="listbox">
                @foreach($banners as $key=>$banner)
                <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                    <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block text-left">
                        <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                        <p>{!! html_entity_decode($banner->description) !!}</p>
                        <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{ $banner->slug }}" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </section>
@endif

<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            @if($categories->count() > 0)
                @foreach($categories as $cat)
                    <!-- Single Banner  -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-banner">
                            @if($cat->photo)
                                <img src="{{$cat->photo}}" alt="{{$cat->photo}}" width="600px" height="370px">
                            @else
                                <img src="https://via.placeholder.com/600x370" alt="photo" width="600px" height="370px">
                            @endif
                            <div class="content">
                                <h3>{{$cat->title}}</h3>
                                    <a href="{{route('product-cat',$cat->slug)}}">Discover Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- /End Single Banner  -->
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                                @if($categories->count() > 0)
                                <button class="btn" style="background:black"data-filter="*">
                                    All
                                </button>
                                    @foreach($categories as $key=>$cat)

                                    <button class="btn" style="background:none;color:black;"data-filter=".{{$cat->id}}">
                                        {{$cat->title}}
                                    </button>
                                    @endforeach
                                @endif
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content isotope-grid" id="myTabContent">
                             <!-- Start Single Tab -->
                            @if($products->count() > 0)
                                @foreach($products as $key=>$product)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{route('product-detail',$product->slug)}}">
                                                @php
                                                    $photo=explode(',',$product->photo);
                                                // dd($photo);
                                                @endphp
                                                <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                @if($product->stock<=0)
                                                    <span class="out-of-stock">Sale out</span>
                                                @elseif($product->condition=='new')
                                                    <span class="new">New</span
                                                @elseif($product->condition=='hot')
                                                    <span class="hot">Hot</span>
                                                @elseif($product->condition=='popular')
                                                    <span class="popular">Popular</span>
                                                @elseif($product->condition=='winter')
                                                    <span class="new">Winter</span>
                                                @else
                                                    <span class="price-dec">{{$product->discount}}% Off</span>
                                                @endif

                                            </a>
                                            <div class="button-head">
                                                <div class="product-action">
                                                    <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                    <a title="Wishlist" href="#" data-product-id="{{ $product->id }}" data-quantity="1" class="add-to-wishlist" id="add-to-wishlist{{ $product->id }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                </div>
                                                <div class="product-action-2">
                                                    {{-- <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a> --}}
                                                    <a title="Add to cart" href="#" data-product-id="{{ $product->id }}" data-quantity="1" class="add-to-cart" id="add-to-cart{{ $product->id }}"><i class="fa fa-cart-plus">&nbsp;Add to cart</i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                            <div class="product-price">

                                                @if ($product->offer_price > 0)
                                                    <span>${{number_format($product->offer_price,2)}}</span>
                                                    <del style="padding-left:4%;">${{number_format($product->price,2)}}</del>
                                                @else
                                                <span>${{number_format($product->price,2)}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                             <!--/ End Single Tab -->
                            @endif

                        <!--/ End Single Tab -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- End Product Area -->

<!-- Start Midium Banner  -->
<section class="midium-banner">
    <div class="container">
        <div class="row">
            @if($featured->count() > 0)
                @foreach($featured as $data)
                    <!-- Single Banner  -->
                    <div class="col-lg-6 col-md-6 col-12" >
                        <div class="single-banner">

                            <img src="{{$data->photo}}" alt="product photo" style="width:555px;height:342.25px;">
                            <div class="content">
                                <p>{{$data->cat_info->title}}</p>
                                <h3>{{$data->title}} <br>Up to<span> {{$data->discount}}%</span></h3>
                                <a href="{{route('product-detail',$data->slug)}}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- /End Single Banner  -->
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Midium Banner -->

<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_hot as $product)
                        @if($product->condition=='hot')
                            <!-- Start Single Product -->
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{route('product-detail',$product->slug)}}">

                                    <img class="default-img" src="{{$product->photo}}" alt="product photo">
                                    <img class="hover-img" src="{{$product->photo}}" alt="product photo">
                                    <span class="out-of-stock">Hot</span>
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" href="#" data-product-id="{{ $product->id }}" data-quantity="1" class="add-to-wishlist" id="add-to-wishlist{{ $product->id }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        {{-- <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a> --}}
                                        <a title="Add to cart" href="#" data-product-id="{{ $product->id }}" data-quantity="1" class="add-to-cart" id="add-to-cart{{ $product->id }}"><i class="fa fa-cart-plus">&nbsp;Add to cart</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                <div class="product-price">
                                    @if($product->offer_price > 0)
                                        <span>${{number_format($product->offer_price,2)}}</span>
                                        <span class="old">${{number_format($product->price,2)}}</span>

                                    @else
                                        <span>${{number_format($product->price,2)}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

<!-- Start Shop Home List  -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Latest Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_latest as $product)
                            <!-- Start Single Product -->
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{route('product-detail',$product->slug)}}">

                                    <img class="default-img" src="{{$product->photo}}" alt="product photo">
                                    <img class="hover-img" src="{{$product->photo}}" alt="product photo">
                                    @if($product->stock<=0)
                                        <span class="out-of-stock">Sale out</span>
                                    @elseif($product->condition=='new')
                                        <span class="new">New</span
                                    @elseif($product->condition=='hot')
                                        <span class="hot">Hot</span>
                                    @elseif($product->condition=='popular')
                                        <span class="popular">Popular</span>
                                    @elseif($product->condition=='winter')
                                        <span class="new">Winter</span>
                                    @else
                                        <span class="price-dec">{{$product->discount}}% Off</span>
                                    @endif
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" href="#" data-product-id="{{ $product->id }}" data-quantity="1" class="add-to-wishlist" id="add-to-wishlist{{ $product->id }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        {{-- <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a> --}}
                                        <a title="Add to cart" href="#" data-product-id="{{ $product->id }}" data-quantity="1" class="add-to-cart" id="add-to-cart{{ $product->id }}"><i class="fa fa-cart-plus">&nbsp;Add to cart</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                <div class="product-price">
                                    @if($product->offer_price > 0)
                                        <span>${{number_format($product->offer_price,2)}}</span>
                                        <span class="old">${{number_format($product->price,2)}}</span>

                                    @else
                                        <span>${{number_format($product->price,2)}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



<!-- End Shop Home List  -->
{{-- @foreach($featured as $data)
    <!-- Start Cowndown Area -->
    <section class="cown-down">
        <div class="section-inner ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12 padding-right">
                        <div class="image">
                            @php
                                $photo=explode(',',$data->photo);
                                // dd($photo);
                            @endphp
                            <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 padding-left">
                        <div class="content">
                            <div class="heading-block">
                                <p class="small-title">Deal of day</p>
                                <h3 class="title">{{$data->title}}</h3>
                                <p class="text">{!! html_entity_decode($data->summary) !!}</p>
                                @php
                                    $after_discount=($product->price-($product->price*$product->discount)/100)
                                @endphp
                                <h1 class="price">${{number_format($after_discount)}} <s>${{number_format($data->price)}}</s></h1>
                                <div class="coming-time">
                                    <div class="clearfix" data-countdown="2021/02/30"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Cowndown Area -->
@endforeach --}}
<!-- Start Shop Blog  -->
{{-- <section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Blog  -->
                        <div class="shop-single-blog">
                            <img src="{{$post->photo}}" alt="{{$post->photo}}">
                            <div class="content">
                                <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                            </div>
                        </div>
                        <!-- End Single Blog  -->
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section> --}}
<!-- End Shop Blog  -->


@include('frontend.pages.newsletter.index')

<!-- Modal -->
@include('frontend.pages.product.modal')
<!-- Modal end -->
@endsection

@push('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>

    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
        background: #000000;
        color:black;
        }

        .hot{
            background-color: rgb(219, 10, 10)
        }

        #Gslider .carousel-inner{
        height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
        bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
<script type='text/javascript' src="{{ asset('frontend') }}/js/cartadd.js"></script>


    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
         function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>



<script>
    $(document).on('click','.add-to-wishlist',function(e){
        var pro_id = $(this).data('product-id')
        var quantity = $(this).data('quantity')
        e.preventDefault();
        $.ajax({
            url:"{{route('wishlist.store')}}",
            type:"POST",
            data:{
                _token:"{{csrf_token()}}",
                quantity:quantity,
                pro_id:pro_id
            },
            beforeSend:function(){
                $('#add-to-wishlist'+pro_id).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            complete:function(){
                $('#add-to-wishlist'+pro_id).html('<i class=" ti-heart "></i>');
            },
            success:function(response){
                response=$.parseJSON(response);
                if(response['status']){
                    $('body #cart-ajax-loader').html(response['header']);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response['message'],
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    });
</script>
@endpush
