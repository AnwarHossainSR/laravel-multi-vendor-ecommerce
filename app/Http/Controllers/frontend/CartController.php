<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cart()
    {
        return \view('frontend.pages.cart.index');
    }
    public function singleAddToCart(Request $request)
    {
        $product = Product::getProductByCart($request->pro_id);
        $price = $product[0]['offer_price'];
        $product_id = $request->input('pro_id');
        $product_title = $product[0]['title'];
        $quantity = $request->input('quantity');

        if($request->input('row_id')){
            $id = $request->input('row_id');
            Cart::instance('wishlist')->remove($id);
            $wishlist = \view('frontend.pages.wishlist.wish')->render();
            $response['wishlist'] = $wishlist;
        }
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
            $cart = \view('frontend.pages.cart.shopping')->render();
            $response['header'] = $header;
            $response['cart'] = $cart;
        }
        return \json_encode($response);
    }
    public function cartUpdate(Request $request)
    {
        $this->validate($request,[
            'product_qty'=>'numeric|required'
        ]);

        $rowId = $request->input('rowId');
        $product_qty = $request->input('product_qty');
        $product_stock = $request->input('product_stock');

        if($product_qty > $product_stock){
            $response['message'] = 'Sorry, we do not have enough item in stock';
            $response['status'] = false;
        }else{
            if($request->input('request') == 'wishlist'){
                Cart::instance('wishlist')->update($rowId,$product_qty);
            }else{
                Cart::instance('shopping')->update($rowId,$product_qty);
            }
            $response['message'] = 'Quantity updated successfully';
            $response['status'] = true;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        if($request->ajax()){
            $response['header'] = \view('frontend.layouts.header')->render();
            $response['wishlist'] = \view('frontend.pages.wishlist.wish')->render();
            $response['cart'] = \view('frontend.pages.cart.shopping')->render();
        }
        return \json_encode($response);
    }
    public function couponAdd(Request $request)
    {
        $coupon = Coupon::findByCode($request->code);
        $total = Cart::instance('shopping')->subtotal();
        $discountTotal = $coupon->afterDiscount($total);
        if($coupon){

            $request->session()->put('coupon', [
                'id'=>$coupon->id,
                'value'=>$coupon->value,
                'discount'=>$coupon->discount($total),
                'code'=>$coupon->code,
                'discountTotal'=>$discountTotal,
                'total_value'=>floatval(preg_replace('/[^\d. ]/', '', $total)),
                'tax'=>floatval(preg_replace('/[^\d. ]/', '', Cart::tax()))
            ]);
            return \back()->with('success','congrats!! Coupon code added successfully');
        }else{
            return \back()->with('error','Coupon code is invalid, Enter a valid code');
        }
    }

    public function cartDestroy()
    {
        Cart::instance('shopping')->destroy();
        return \back()->with('success','Cart has been destroyed');
    }


}
