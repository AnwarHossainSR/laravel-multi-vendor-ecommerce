
$(document).on('click', '.add-to-cart', function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
    var pro_id = $(this).data('product-id')
    var quantity = $(this).data('quantity')
    var row_id = $(this).data('id')
    e.preventDefault();

    $.ajax({
        url:route('cart.store'),
        type:"POST",
        data:{
            quantity:quantity,
            pro_id: pro_id,
            row_id:row_id
        },
        beforeSend:function(){
            $('#add-to-cart'+pro_id).html('<i class="fa fa-spinner fa-spin"></i>');
        },
        complete:function(){
            $('#add-to-cart'+pro_id).html('<i class="fa fa-cart-plus"></i> ADD TO CART');
        },
        success:function(response){
            response=$.parseJSON(response);
            if(response['status']){
                $('body #cart-ajax-loader').html(response['header']);
                if (response['wishlist']) {
                    $('body #cart-page-ajax-loader').html(response['wishlist']);
                }
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
