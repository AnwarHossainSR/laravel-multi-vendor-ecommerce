<?php

namespace App\Http\Controllers\frontend\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function userDashboard()
    {
        return \view('frontend.user.dashboard');
    }

    public function orderIndex(){
        //$orders=Order::orderBy('id','DESC')->where('user_id',auth()->user()->id)->paginate(10);
        return view('frontend.user.order');
    }


    /* public function userOrderDelete($id)
    {
        $order=Order::find($id);
        if($order){
           if($order->status=="process" || $order->status=='delivered' || $order->status=='cancel'){
                return redirect()->back()->with('error','You can not delete this order now');
           }
           else{
                $status=$order->delete();
                if($status){
                    request()->session()->flash('success','Order Successfully deleted');
                }
                else{
                    request()->session()->flash('error','Order can not deleted');
                }
                return redirect()->route('user.order.index');
           }
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    } */

   /*  public function orderShow($id)
    {
        $order=Order::find($id);
        // return $order;
        return view('user.order.show')->with('order',$order);
    } */
    // Product Review
   /*  public function productReviewIndex(){
        $reviews=ProductReview::getAllUserReview();
        return view('user.review.index')->with('reviews',$reviews);
    } */


    public function userAddress()
    {
        $user = Auth::user();
        return \view('frontend.user.address',\compact('user'));
    }
    public function userBillingAddress(Request $request)
    {
        $user = User::find(Auth::id());
        if ($user->userAddress) {
            $address = Address::find($user->userAddress->id);
            $address->city = $request->city;
            $address->postcode = $request->postcode;
            $address->address = $request->address;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->update();
            return \back()->with('success','Billing address has been updated');

        } else {
            $address = new Address;
            $address->city = $request->city;
            $address->postcode = $request->postcode;
            $address->address = $request->address;
            $address->state = $request->state;
            $address->country = $request->country;
            $user->userAddress()->save($address);
            return \back()->with('success','Billing address has been added');
        }


    }
    public function userShippingAddress(Request $request)
    {
        $user = User::find(Auth::id());
        if ($user->userAddress) {
            $address = Address::find($user->userAddress->id);
            $address->scity = $request->city;
            $address->spostcode = $request->postcode;
            $address->saddress = $request->address;
            $address->sstate = $request->state;
            $address->scountry = $request->country;
            $address->update();
            return \back()->with('success','Shipping address has been updated');

        } else {
            $address = new Address;
            $address->scity = $request->city;
            $address->spostcode = $request->postcode;
            $address->saddress = $request->address;
            $address->sstate = $request->state;
            $address->scountry = $request->country;
            $user->userAddress()->save($address);
            return \back()->with('success','Shipping address has been added');
        }
    }
    public function userAccount()
    {
        return \view('frontend.user.account');
    }

    public function userAccountUpdate(Request $request)
    {
        $user=User::findOrFail(Auth::id());
        $data= $request->all();
        if($request->cpassword == null && $request->password == null){
            $status=$user->fill($data)->save();
        }elseif ($request->cpassword == null || $request->password == null) {
            return \back()->with('error','current password and new password both required');
        } else{
            if (Hash::check($request->cpassword, $user->password)) {
                if (!Hash::check($request->password, $user->password)) {
                    $user->update([
                        'full_name'=>$request->full_name,
                        'username'=>$request->username,
                        'phone'=>$request->phone,
                        'photo'=>$request->photo,
                        'password'=>Hash::make($request->password),
                    ]);
                    Auth::logout();
                    return back()->with('success','information successfully updated');
                } else {
                    return \back()->with('error','New password can not be same as old password');
                }
            } else {
                return \back()->with('error','Current password does not matched');
            }


        }
        // return $data;

        if($status){
            request()->session()->flash('success','information successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return \back();
    }


   /*  public function productReviewEdit($id)
    {
        $review=ProductReview::find($id);
        // return $review;
        return view('user.review.edit')->with('review',$review);
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /*  public function productReviewUpdate(Request $request, $id)
    {
        $review=ProductReview::find($id);
        if($review){
            $data=$request->all();
            $status=$review->fill($data)->update();
            if($status){
                request()->session()->flash('success','Review Successfully updated');
            }
            else{
                request()->session()->flash('error','Something went wrong! Please try again!!');
            }
        }
        else{
            request()->session()->flash('error','Review not found!!');
        }

        return redirect()->route('user.productreview.index');
    } */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /*  public function productReviewDelete($id)
    {
        $review=ProductReview::find($id);
        $status=$review->delete();
        if($status){
            request()->session()->flash('success','Successfully deleted review');
        }
        else{
            request()->session()->flash('error','Something went wrong! Try again');
        }
        return redirect()->route('user.productreview.index');
    } */

   /*  public function userComment()
    {
        $comments=PostComment::getAllUserComments();
        return view('user.comment.index')->with('comments',$comments);
    } */
   /*  public function userCommentDelete($id){
        $comment=PostComment::find($id);
        if($comment){
            $status=$comment->delete();
            if($status){
                request()->session()->flash('success','Post Comment successfully deleted');
            }
            else{
                request()->session()->flash('error','Error occurred please try again');
            }
            return back();
        }
        else{
            request()->session()->flash('error','Post Comment not found');
            return redirect()->back();
        }
    } */
   /*  public function userCommentEdit($id)
    {
        $comments=PostComment::find($id);
        if($comments){
            return view('user.comment.edit')->with('comment',$comments);
        }
        else{
            request()->session()->flash('error','Comment not found');
            return redirect()->back();
        }
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /*  public function userCommentUpdate(Request $request, $id)
    {
        $comment=PostComment::find($id);
        if($comment){
            $data=$request->all();
            // return $data;
            $status=$comment->fill($data)->update();
            if($status){
                request()->session()->flash('success','Comment successfully updated');
            }
            else{
                request()->session()->flash('error','Something went wrong! Please try again!!');
            }
            return redirect()->route('user.post-comment.index');
        }
        else{
            request()->session()->flash('error','Comment not found');
            return redirect()->back();
        }

    } */

    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }
   /*  public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('user')->with('success','Password successfully changed');
    } */
}
