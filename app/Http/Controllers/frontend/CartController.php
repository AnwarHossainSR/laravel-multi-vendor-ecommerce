<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function singleAddToCart(Request $request)
    {
        $product = Product::getProductByCart($request->pro_id);
        $price = $product[0]['offer_price'];
        $photo = $product[0]['photo'];
        $product_id = $request->input('pro_id');
        $product_title = $product[0]['title'];
        $quantity = $request->input('quantity');
        /* $cart_array = [];

        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        } */


        $result = Cart::instance('shopping')->add($product_id,$product_title,$quantity,$price)->associate('App\Models\Product');
        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = 'Item added to cart';

        } else {
            $response['message'] = 'Something is wrong';
        }

        if($request->ajax()){
            $header = \view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }

        return \json_encode($response);
    }

    public function cartRemove(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = 'Item removed from cart';
        if($request->ajax()){
            $header = \view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return \json_encode($response);
    }
}
