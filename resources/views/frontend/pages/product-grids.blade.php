@extends('frontend.layouts.master')

@section('title','E-SHOP || PRODUCT PAGE')

@section('main-content')
	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home</a></li> /
                            <li class="active"><a href="{{ route('product-cat',$categoryinfo[0]->slug) }}">{{ $categoryinfo[0]->title }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Style -->
    {{-- <form action="{{route('shop.filter')}}" method="POST">
        @csrf --}}
        <section class="product-area shop-sidebar shop section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
										{{-- @php
											// $category = new Category();
											$menu=App\Models\Category::getAllParentWithChild();
										@endphp --}}
										@if($menu->count() > 0)
										<li>
											@foreach($menu as $cat_info)
													@if($cat_info->child_cat->count()>0)
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
															<ul>
																@foreach($cat_info->child_cat as $sub_menu)
																	<li><a href="{{-- {{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}} --}}">{{$sub_menu->title}}</a></li>
																@endforeach
															</ul>
														</li>
													@else
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
													@endif
											@endforeach
										</li>
										@endif
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Shop By Price -->
                                    <div class="single-widget range">
                                        <h3 class="title">Shop by Price</h3>
                                        <div class="price-filter">
                                            <div class="price-filter-inner">

                                                <div id="slider-range" data-min="0" data-max="{{$max}}"></div>
                                                <div class="product_filter">
                                                <button type="submit" class="filter_button">Filter</button>
                                                <div class="label-input">
                                                    <span>Range:</span>
                                                    <input style="" type="text" id="amount" readonly/>
                                                    <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <ul class="check-box-list">
                                            <li>
                                                <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox">$20 - $50<span class="count">(3)</span></label>
                                            </li>
                                            <li>
                                                <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">$50 - $100<span class="count">(5)</span></label>
                                            </li>
                                            <li>
                                                <label class="checkbox-inline" for="3"><input name="news" id="3" type="checkbox">$100 - $250<span class="count">(8)</span></label>
                                            </li>
                                        </ul> --}}
                                    </div>
                                    <!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recent post</h3>
                                    {{-- {{dd($recent_products)}} --}}
                                    @foreach($recent_products as $product)
                                        <!-- Single Post -->
                                        <div class="single-post first">
                                            <div class="image">
                                                <img src="{{$product->photo}}" alt="product photo">
                                            </div>
                                            <div class="content">
                                                <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h5>

                                                <p class="price"><del class="text-muted">${{number_format($product->price,2)}}</del>   ${{number_format($product->offer_price,2)}}  </p>

                                            </div>
                                        </div>
                                        <!-- End Single Post -->
                                    @endforeach
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Brands</h3>
                                    <ul class="categor-list">

                                        @foreach($brands as $brand)
                                            <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!-- Shop Top -->
                                <div class="shop-top">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Show :</label>
                                            <select class="show" name="show" onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
                                                <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
                                                <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
                                                <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
                                            </select>
                                        </div>
                                        <div class="single-shorter">
                                            <label>Sort By :</label>
                                            <select id="sortBy" class='sortBy' name='sortBy'>
                                                <option value="">Default</option>
                                                <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceAsc') selected @endif>Price - Lower TO Higher</option>
                                                <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceDesc') selected @endif>Price - Higher To Lower</option>
                                                <option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleAsc') selected @endif>Alphabetical Ascending</option>
                                                <option value="titleDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleDesc') selected @endif>Alphabetical Descending</option>
                                                <option value="disAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='disAsc') selected @endif>Discount - Lower To Higher</option>
                                                <option value="disDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='disDesc') selected @endif>Discount - Higher To Lower</option>
                                            </select>
                                        </div>
                                    </div>
                                    <ul class="view-mode">
                                        <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-large"></i></a></li>
                                        <li><a href="{{route('product-lists')}}"><i class="fa fa-th-list"></i></a></li>
                                    </ul>
                                </div>
                                <!--/ End Shop Top -->
                            </div>
                        </div>
                        <div class="row" id="product-data">
                            @include('frontend.layouts.single-product')

                        </div>
                        <div class="mx-4 mt-5 d-flex justify-content-center">
                            <div class="ajax-load text-center" style="display: none">
                                <img id="img-loader" src="{{ asset('frontend') }}/img/loader.gif" style="width: 40%;">
                            </div>
                            <button id="load-more-data" class="btn btn-outline-danger text-light">Load more</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     {{-- </form> --}}


    <!--/ End Product Style 1  -->



    <!-- Modal -->

    @include('frontend.pages.product.modal')
    <!-- Modal end -->

@endsection
@push('styles')
<style>
    .pagination{
        display:inline-flex;
    }
    .filter_button{
        /* height:20px; */
        text-align: center;
        background:#F7941D;
        padding:8px 16px;
        margin-top:10px;
        color: white;
    }
</style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
                    else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
    <script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>
    <script>
        $('#sortBy').change(function(){
            var sort = $('#sortBy').val()
            window.location = "{{ url(''.$route.'') }}/{{ $categoryinfo[0]->slug }}?sort="+sort
        });
    </script>
    <script>
        function loadMoreData(page) {
            $.ajax({
                url:'?page='+page,
                type:'get',
                beforeSend:function(){
                    $('#load-more-data').hide()
                    $('.ajax-load').show();
                }
            }).done(function (data) {
                setTimeout(function(){
                    if(data.html == ''){
                        $('#img-loader').hide();
                        $('.ajax-load').append('<p class="text-danger">no more product availabe at this moment</p>');
                        return;
                    }
                    $('.ajax-load').hide();
                    $('#load-more-data').show();
                    $('#product-data').append(data.html);
                },3000);

             }).fail(function () {
                 alert('somethisg is wrong, please try again');
              })
         }
        var page = 1;
        $('#load-more-data').click(function () {
            page++
            loadMoreData(page)
        })

        /*  $(window).scroll(function () {
            if($(window).scrollTop() + $(window).height()+70 >= $(document).height()){
                console.log('scroll')
                page++
                loadMoreData(page)
            }
          }) */
    </script>
@endpush
