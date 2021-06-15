<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Str;

class ProductControllert extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::latest()->get();
        // return $products;
        return view('backend.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=Brand::get();
        $categories=Category::where('is_parent',1)->get();
        $vendors = User::where('role','vendor')->get();
        // return $category;
        return view('backend.product.create',\compact('categories','brands','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:new,hot,popular,winter',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();

        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        if($request->discount != null){
            $data['offer_price'] = ($request->price-($request->price*$request->discount)/100);
        }
        if($request->has('is_featured')){
            $data['is_featured']=true;
        }else{
            $data['is_featured']=$request->input('is_featured',false);
        }
        //return $data;
        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productView(Request $request)
    {
        $product = Product::find($request->id);
        if($product){
            $brand = Brand::where('id',$product->brand_id)->pluck('title');
            $category = Category::where('id',$product->cat_id)->pluck('title');
            $vendor = User::where('id',$product->vendor_id)->pluck('full_name');
            $chiled_category = Category::where('id',$product->child_cat_id)->pluck('title');
            return \response()->json(['msg'=>'success','status'=>true,'data'=>$product,'brand'=>$brand,'category'=>$category,'vendor'=>$vendor,'chiled_category'=>$chiled_category,]);
        }else{
            return \response()->json(['msg'=>'no data found','data'=>'']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::get();
        $product=Product::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        //$items=Product::where('id',$id)->get();
        $vendors = User::where('role','vendor')->get();
        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('brands',$brand)
                    ->with('categories',$category)->with('vendors',$vendors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            //'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:new,hot,popular,window',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        if($request->discount != null){
            $data['offer_price'] = ($request->price-($request->price*$request->discount)/100);
        }
        if($request->has('is_featured')){
            $data['is_featured']=true;
        }else{
            $data['is_featured']=$request->input('is_featured',false);
        }
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();

        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }

    public function productStatus(Request $request)
    {
        if($request->mode == 'true'){
            Product::where("id", $request->id)->update(['status'=>'active']);
        }
        else{
            Product::where("id", $request->id)->update(['status'=>'inactive']);
        }

        return \response()->json(['msg'=>'status successfully updated','status'=>true]);
    }
}
