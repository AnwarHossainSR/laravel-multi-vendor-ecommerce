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
                            <th class="text-center">TOTAL</th>
                            <th class="text-center"><a href="{{ route('cart.destroy') }}"><i class="fa fa-cart-plus"></i></a></th>
                            <th class="text-center"><a href="{{ route('cart.destroy') }}"><i class="ti-trash remove-icon"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::instance('wishlist')->content() as $key => $item)
                        <tr>
                            <td class="image" data-title="No"><img src="{{ $item->model->photo }}" alt="#"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="">{{ $item->name }}</a></p>
                            </td>
                            <td class="price" data-title="Price"><span>${{ $item->price }} </span></td>
                            <td class="total-amount" data-title="Total"><span>${{ $item->subtotal() }}</span></td>
                            <td class="action add-to-cart" data-product-id="{{ $item->id }}" data-quantity="1" id="add-to-cart{{ $item->id }}" data-id="{{ $item->rowId }}" data-title="Add Ton Cart"><a href="#"><i class="fa fa-cart-plus"></i></a></td>
                            <td class="action wishlist-delete" data-id="{{ $item->rowId }}" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script type='text/javascript' src="{{ asset('frontend') }}/js/cartadd.js"></script>

<script>
    $(document).on('click','.wishlist-delete',function(e){
        var cart_id = $(this).data('id')
        e.preventDefault();
        $.ajax({
            url:"{{route('wishlist.remove')}}",
            type:"POST",
            data:{
                _token:"{{csrf_token()}}",
                cart_id:cart_id
            },
            success:function(response){
                response=$.parseJSON(response);

                if(response['status']){
                    console.log('success')
                    $('body #cart-ajax-loader').html(response['header']);
                    $('body #cart-page-ajax-loader').html(response['wishlist']);

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
