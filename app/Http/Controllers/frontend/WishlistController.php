<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishList()
    {
        return \view('frontend.pages.wishlist.wishlist');
    }
    public function singleAddToWishlist(Request $request)
    {
        $product = Product::getProductByCart($request->pro_id);
        $price = $product[0]['offer_price'];
        $product_id = $request->input('pro_id');
        $product_title = $product[0]['title'];
        $quantity = $request->input('quantity');

        $wishlist_array=[];
        foreach (Cart::instance('wishlist')->content() as $key => $item) {
            $wishlist_array[]=$item->id;
        }
        if(\in_array($product_id,$wishlist_array)){
            $response['status'] = true;
            $response['message'] = "Item is already in your wishlist";
        }else{
            $result = Cart::instance('wishlist')->add($product_id,$product_title,$quantity,$price)->associate('App\Models\Product');
            if ($result) {
                $response['status'] = true;
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
                $response['message'] = 'Item added to wishlist';
            } else {
                $response['message'] = 'Something is wrong';
            }
        }
        if($request->ajax()){
            $header = \view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }

        return \json_encode($response);
    }

    public function wishlistRemove(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('wishlist')->remove($id);
        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('wishlist')->count();
        $response['message'] = 'Item removed from wishlist';
        if($request->ajax()){
            $header = \view('frontend.layouts.header')->render();
            $wishlist = \view('frontend.pages.wishlist.wish')->render();
            $response['header'] = $header;
            $response['wishlist'] = $wishlist;
        }
        return \json_encode($response);
    }
}
