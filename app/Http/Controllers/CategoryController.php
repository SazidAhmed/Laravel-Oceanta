<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Category;
use App\Subcategory;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::get();
        $subcategories = Subcategory::get();
        return view('product.category',compact('categories', 'subcategories'));
    }
   
    public function store(Request $request)
    {
        // dd($request);S
        $this->validate($request,[
            'name'=>'required|unique:categories',
            'image'=>'required|mimes:jpeg,jpg,png'
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img = $data['name'].time(). '.' .$data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/catImg'),$img);
        }else{
            $img = 'avatar.png';
        }
        
        $success = Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'image'=>$img
        ]);
        return redirect()->back()->with('message', 'Category Created successfully!');

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $category = Category::find($id);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
            $image = $request->file('image');
            $img = $data['name'] . time() . '.' . $data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/catImg'),$img);

            $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/catImg')."/".$category->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else{
            $img = $category->image;
        }

        $category->name= $request->name;
        $category->slug= Str::slug($request->name);
        $category->image=$img;
        $success = $category->save();
        
        return redirect()->back()->with('message', 'Category Updated successfully!');
    }

    public function destroy($id)
    {

        $category = Category::find($id);
        $category->delete();
        $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/catImg')."/".$category->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        return redirect()->back()->with('message', 'Category Deleted successfully!');
    }
}
