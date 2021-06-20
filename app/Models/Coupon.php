<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=['code','type','value','status'];

    public static function findByCode($code){
        return self::where('code',$code)->first();
    }
    public function afterDiscount($total){
        if($this->type=="fixed"){
            return $this->value;
        }
        elseif($this->type=="percent"){
            return floatval(preg_replace('/[^\d. ]/', '', Cart::total()))-((floatval($this->value) / 100) * floatval(preg_replace('/[^\d. ]/', '', $total)));
            //return floatval(preg_replace('/[^\d. ]/', '', $total)) - $amount;
        }
        else{
            return 0;
        }
    }
    public function discount($total){
        if($this->type=="fixed"){
            return $this->value;
        }
        elseif($this->type=="percent"){
            return ((floatval($this->value) / 100) * floatval(preg_replace('/[^\d. ]/', '', $total)));
        }
        else{
            return 0;
        }
    }
}

