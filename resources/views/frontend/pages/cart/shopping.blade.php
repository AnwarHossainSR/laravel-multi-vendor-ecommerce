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
                            <th class="text-center"><a href="{{ route('cart.destroy') }}"><i class="ti-trash remove-icon"></i></a></th>
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
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[{{$key}}]">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" name="quant[{{$key}}]" class="input-number" id="qty-input-{{ $item->rowId }}" data-id="{{ $item->rowId }}"  data-min="1" data-max="100" value="{{ $item->qty }}">
                                    <input type="number" data-id="{{ $item->rowId }}" data-product-quantity="{{ $item->model->stock }}" id="update-cart-{{ $item->rowId }}" hidden>
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$key}}]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </td>
                            <td class="total-amount" data-title="Total"><span>${{ $item->subtotal() }}</span></td>
                            <td class="action cart-delete" data-id="{{ $item->rowId }}" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
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
                            <div class="left">
                                <div class="coupon">
                                    <form action="{{ route('coupon.add') }}" id="coupon-form" method="POST">
                                        @csrf
                                        <input name="code" placeholder="Enter Your Coupon">
                                        <button type="submit" class="btn coupon-btn">Apply</button>
                                    </form>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span>${{ Cart::instance('shopping')->subtotal() }}</span></li>
                                    <li>Tax<span>${{ Cart::instance('shopping')->tax() }}</span></li>
                                    @if(session()->has('coupon'))
                                       @if (Cart::count() > 0)
                                       <li>Total Amount<span>${{ Cart::total() }}</span></li>
                                       <li>Discount({{ session('coupon')['value'] }} $/%)<span>${{ session('coupon')['discount'] }}</span></li>
                                       <li class="last">You Pay<span>${{  session('coupon')['discountTotal'] }}</span></li>
                                       @else
                                       <li class="last">You Pay<span>${{ 0.00 }}</span></li>
                                       @endif
                                    @else
                                    <li class="last">You Pay<span>${{ Cart::total() }}</span></li>
                                    @endif
                                </ul>
                                <div class="button5">
                                    <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                    <a href="{{ route('home') }}" class="btn">Continue shopping</a>
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

@push('scripts')
<script>
    $(document).on('change','.input-number',function(e){
        e.preventDefault();
        var id = $(this).data('id')
        var cart_qty = parseInt($(this).val());
        var product_stock = $('#update-cart-'+id).data('product-quantity');
        updateCart(id,cart_qty,product_stock)
    });

    function updateCart(id,cart_qty,product_stock){
        $.ajax({
            url:"{{route('cart.update')}}",
            type:"POST",
            data:{
                _token:"{{csrf_token()}}",
                rowId:id,
                product_qty:cart_qty,
                product_stock:product_stock
            },
            success:function(response){
                response=$.parseJSON(response);
                if(response['message']){
                    $('body #cart-ajax-loader').html(response['header']);
                    $('body #cart-page-ajax-loader').html(response['cart']);
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
    }
</script>
<script>
    $(document).on('click','.coupon-btn',function(e){
        e.preventDefault();
        var code = $('input[name=code]').val()
        $('.coupon-btn').html('<i class="fa fa-spinner fa-spin"></i> Applying..')
        $('#coupon-form').submit();
    });
</script>
@endpush
