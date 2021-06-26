<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Jobs\OrderEmailJob;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{
    public function checkout()
    {
        return \view('frontend.pages.checkout.checkout');
    }

    public function checkoutShipping(Request $request)
    {
        session()->put('checkout',[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note' => $request->note,
            //billing
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'address' => $request->address,
            //shipping
            'scountry' => $request->scountry,
            'scity' => $request->scity,
            'sstate' => $request->sstate,
            'spostcode' => $request->spostcode,
            'saddress' => $request->saddress,
        ]);

        $shippings = Shipping::where('status','active')->latest()->get();
        return \view('frontend.pages.checkout.checkout2',\compact('shippings'));
    }
    public function checkoutPayment(Request $request)
    {
        Session::push('checkout',[
            'shipping_id'=>$request->delivery_type
        ]);
        return \view('frontend.pages.checkout.checkout3');
    }
    public function checkoutOrder(Request $request)
    {
        $shipping = Shipping::find(Session::get('checkout')[0]['shipping_id']);
        Session::push('checkout',[
            'payment_method'=>$request->payment_method,
            'payment_status'=>'paid',
            'card_no'=>$request->card_no,
            'expire'=>$request->expire,
            'security_code'=>$request->security_code,
            'delivery_charge'=> $shipping->delivery_charge,
        ]);

        return \view('frontend.pages.checkout.checkout4',\compact('shipping'));
    }
    public function orderStore(Request $request)
    {
        Session::push('checkout',[
            'total_amount'=>$request->total_amount,
            'sub_total'=>$request->sub_total,
        ]);

        //return Session::get('checkout');

        $order = new Order();
        $order['user_id']=Auth::user()->id;
        $order['order_number']='ORD-'.strtoupper(Str::random(10));
        $order['sub_total']=Session::get('checkout')[2]['sub_total'];
        $order['shipping_id']= Session::get('checkout')[0]['shipping_id'];
        if (Session::has('coupon')) {
            $order['total_amount']=Session::get('coupon')['discountTotal'];
        } else {
            $order['total_amount']=Session::get('checkout')[2]['total_amount'];
        }

        $order['delivery_charge']=Session::get('checkout')[1]['delivery_charge'];
        $order['payment_method']=Session::get('checkout')[1]['payment_method'];
        $order['payment_status'] = 'paid';
        $order['status'] = 'pending';
        $order['first_name']=Session::get('checkout')['first_name'];
        $order['last_name']=Session::get('checkout')['last_name'];
        $order['email']=Session::get('checkout')['email'];
        $order['phone']=Session::get('checkout')['phone'];
        //billing
        $order['country']=Session::get('checkout')['country'];
        $order['city']=Session::get('checkout')['city'];
        $order['address']=Session::get('checkout')['address'];
        $order['state']=Session::get('checkout')['state'];
        $order['postcode']=Session::get('checkout')['postcode'];
        //shipping
        $order['scountry']=Session::get('checkout')['scountry'];
        $order['scity']=Session::get('checkout')['scity'];
        $order['saddress']=Session::get('checkout')['saddress'];
        $order['sstate']=Session::get('checkout')['sstate'];
        $order['spostcode']=Session::get('checkout')['spostcode'];
        $order['note']=Session::get('checkout')['note'];
        if(Session::has('coupon')){
            $order['coupon']= Session::get('coupon')['discount'];
        }
        //return Session::get('checkout');
        $last_order = $order->save();
        if ($last_order) {
            $payment = new Payment();
            $payment['card_no']=Session::get('checkout')[1]['card_no'];
            $payment['expire']=Session::get('checkout')[1]['expire'];
            $payment['security_code']=Session::get('checkout')[1]['security_code'];
            $payment['order_no']=$order['order_number'];

            $payment->save();
        } else {
            Session::forget('coupon');
            Session::forget('checkout');
            return \redirect()->route('checkout')->with('something is wrong, please try again');
        }

        //Mail::to($order['email'])->cc('mahedisr@gmail.com')->send(new OrderMail($order));
        dispatch(new OrderEmailJob($order))->delay(now()->addSeconds(5));
        Cart::instance('shopping')->destroy();
        Session::forget('coupon');
        Session::forget('checkout');
        return \redirect()->route('checkout')->with('success','Ordere is in processing');
    }
}
