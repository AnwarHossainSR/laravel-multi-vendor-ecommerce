
@foreach($products as $product)
<div class="col-lg-4 col-md-6 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="{{route('product-detail',$product->slug)}}">
            @php
                $photo=explode(',',$product->photo);
            @endphp
            <img class="default-img" src="{{$photo[0]}}" alt="product photo">
            <img class="hover-img" src="{{$photo[0]}}" alt="product photo">
                @if($product->discount)
                    <span class="price-dec">{{$product->discount}} % Off</span>
                @endif
            </a>
            <div class="button-head">
                <div class="product-action">
                    <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                    <a title="Wishlist" href="" class="wishlist" data-id="{{$product->id}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                </div>
                <div class="product-action-2">
                    <a title="Add to cart" href="">Add to cart</a>
                </div>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
            {{-- @php
                $after_discount=($product->price-($product->price*$product->discount)/100);
            @endphp --}}
            <span>${{number_format($product->offer_price,2)}}</span>
            <del style="padding-left:4%;">${{number_format($product->price,2)}}</del>
        </div>
    </div>
</div>
@endforeach
