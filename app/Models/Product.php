<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=['title','slug','summary','description','cat_id','child_cat_id','price','offer_price','brand_id','discount','status','photo','size','stock','is_featured','condition','vendor_id'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }

    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function getReview(){
        //model , foreign key , local key
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    /* public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    } */

    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods'])->where('slug',$slug)->first();
    }

    //
    public static function getProductByCart($id)
    {
        return self::where('id',$id)->get()->toArray();
    }
}
