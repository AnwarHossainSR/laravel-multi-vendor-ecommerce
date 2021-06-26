<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','order_number','sub_total','quantity','delivery_charge','status','total_amount','payment_method','payment_status','shipping_id','coupon','first_name','last_name','phone','email','country','postcode','state','address','city','scountry','spostcode','sstate','saddress','scity','note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
