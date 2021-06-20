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
@include('frontend.pages.cart.shopping')
<!--/ End Shopping Cart -->
@endsection
@push('scripts')
<script>
    $(document).on('click','.cart-delete',function(e){
        var cart_id = $(this).data('id')
        e.preventDefault();
        $.ajax({
            url:"{{route('cart.remove')}}",
            type:"POST",
            data:{
                _token:"{{csrf_token()}}",
                cart_id:cart_id
            },
            success:function(response){
                response=$.parseJSON(response);

                if(response['status']){
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
    });
</script>

@endpush
