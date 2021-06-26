<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home()
    {
        $featured=Product::where('status','active')->where('is_featured',1)->orderBy('price','DESC')->limit(2)->get();
        //$posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        // return $banner;
        $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $product_hot=Product::where(['status'=>'active','condition'=>'hot'])->orderBy('id','DESC')->limit(8)->get();
        $categories=Category::where(['status'=>'active','is_parent'=>1])->limit(3)->orderBy('title','ASC')->get();
        $category_header=Category::where(['status'=>'active'])->get()->random(6);
        //inRandomOrder()->limit(10)
        $product_latest=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        return \view('frontend.index',\compact('banners','categories','category_header','products','featured','product_latest','product_hot'));
    }

    public function productCategory(Request $request,$slug)
    {
        $categories=Category::getProductByCat($slug);
        if($categories == null){
            return \view('errors.404');
        }

        if($request->sort && $request != null){
            $sort = $request->sort;
            if($sort == 'priceAsc'){
                $products = Category::getProductByCateWithfiltered($categories->id,'offer_price','ASC');
            }elseif ($sort == 'priceDesc') {
                $products = Category::getProductByCateWithfiltered($categories->id,'offer_price','DESC');
            }elseif ($sort == 'titleAsc') {
                $products = Category::getProductByCateWithfiltered($categories->id,'title','ASC');
            }elseif ($sort == 'titleDesc') {
                $products = Category::getProductByCateWithfiltered($categories->id,'title','DESC');
            }elseif ($sort == 'disAsc') {
                $products = Category::getProductByCateWithfiltered($categories->id,'price','ASC');
            }elseif ($sort == 'disDesc') {
                $products = Category::getProductByCateWithfiltered($categories->id,'price','DESC');
            }
        }else{
            $products=$categories->products()->paginate(15);
        }

        $categoryinfo = Category::cat_info($slug);
        $route = 'product-cat';
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $menu=Category::getAllParentWithChild();
        $max=DB::table('products')->max('price');
        $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();

        if($request->ajax()){
            $view = \view('frontend.layouts.single-product',\compact('products'))->render();
            return \response()->json(['html'=>$view]);
        }
        return view('frontend.pages.product-grids',\compact('recent_products','menu','max','brands','categoryinfo','route','products'));

       /*  if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        } */
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug);
        return view('frontend.pages.product_detail')->with('product_detail',$product_detail);
    }

    public function productBrand($slug){
        $products=Brand::getProductByBrand($slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }






    /* public function productLists(){
        $products=Product::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }
        // Sort by name , price, category


        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productFilter(Request $request){
        $data= $request->all();
        // return $data;
        $showURL="";
        if(!empty($data['show'])){
            $showURL .='&show='.$data['show'];
        }

        $sortByURL='';
        if(!empty($data['sortBy'])){
            $sortByURL .='&sortBy='.$data['sortBy'];
        }

        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $brandURL="";
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandURL)){
                    $brandURL .='&brand='.$brand;
                }
                else{
                    $brandURL .=','.$brand;
                }
            }
        }
        // return $brandURL;

        $priceRangeURL="";
        if(!empty($data['price_range'])){
            $priceRangeURL .='&price='.$data['price_range'];
        }
        if(request()->is('e-shop.loc/product-grids')){
            return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
        }
        else{
            return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
        }
    } */
}
