<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    protected $fillable=['title','slug','status'];

    public static function getBlogByTag($slug){
        $posts = Post::all();
        //return $posts;
        $result = [];
        foreach($posts as $post){
            $tags=explode(',',$post->tags);
            foreach($tags as $tag){
                if($tag == $slug){
                    \array_push($result,$post);
                }
            }
        }
        //return Post::where('tags',$slug)->paginate(10);
        return $result;
    }
}
