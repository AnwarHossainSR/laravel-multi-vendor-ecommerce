<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable=['title','slug','status'];

    public function post(){
        return $this->hasMany('App\Models\Post','post_cat_id','id')->where('status','active');
    }
    public static function getBlogByCategory($slug){
        $cat_id = PostCategory::where('slug',$slug)->pluck('id');
        return Post::where('post_cat_id',$cat_id)->paginate(10);
    }

}
