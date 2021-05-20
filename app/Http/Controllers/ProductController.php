<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Subcategory;
use App\Category;
use App\ProductImage;

class ProductController extends Controller
{
   public function index(){
      $products = Product::latest()->paginate(10);
      $image = ProductImage::latest()->paginate(10);
      return view('product.product',compact('products', 'image'));
   }

   public function store(Request $request){
      // dd($request);
      
      $this->validate($request,[
         'name'=>'required',
         'section'=>'required',
         'description'=>'required|min:3',
         'image'=>'required|mimes:jpeg,png,jpg',
         'price'=>'required|numeric',
         'stock'=>'required|numeric',
         'additional_info'=>'required',
         'category_id'=>'required'
      ]);
      // dd($request);
      $data = $request->all();
      if($request->hasFile('image')){
         $image = $request->file('image');
         $img = $data['name'].time(). '.' .$data['image']->getClientOriginalExtension();
         $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/proImg'),$img);
      }else{
         $img = 'avatar.png';
      }
      Product::create([
         'name'=>$request->name,
         'section'=>$request->section,
         'description'=>$request->description,
         'image'=>$img,
         'price'=>$request->price,
         'stock'=>$request->stock,
         'additional_info'=>$request->additional_info,
         'category_id'=>$request->category_id,
         'subcategory_id'=>$request->subcategory_id
      ]);
      return redirect()->back()->with('message', 'Product Has Been Created successfully!');  
   }

   public function update(Request $request,$id){
      $product = Product::find($id);
        
      $data = $request->all();
      if($request->hasFile('image')){
         $this->validate($request,[
               'image'=>'required|mimes:jpeg,jpg,png',
         ]);
         $image = $request->file('image');
         $img = $data['name'] . time() . '.' . $data['image']->getClientOriginalExtension();
         $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/proImg'),$img);

         $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/proImg')."/".$product->image;  
         if(File::exists($image_path)) {
            File::delete($image_path);
         }
      }else{
         $img = $product->image;
      }

      $product->name = $request->name;
      $product->section= $request->section;
      $product->description= $request->description;
      $product->image=$img;
      $product->price=$request->price;
      $product->stock=$request->stock;
      $product->additional_info = $request->additional_info;
      $product->category_id = $request->category_id;
      $product->subcategory_id = $request->subcategory_id;
      $product->save();
      return redirect()->back()->with('message', 'Product Has Been Updated successfully!');
   }

    public function destroy($id){

      $product = Product::find($id);
      $product->delete();
      $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/proImg')."/".$product->image;  
         if(File::exists($image_path)) {
            File::delete($image_path);
         }
      return redirect()->back()->with('message', 'Product Deleted successfully!');
   }

    public function loadSubCategories(Request $request,$id){
        $subcategory  = Subcategory::where('category_id',$id)->pluck('name','id');
        return response()->json($subcategory);
    }
    //http://shopcorner.saz/subcatories/24
    // notify()->success('Product deleted successfully!');
   // return redirect()->route('product.index');

}
