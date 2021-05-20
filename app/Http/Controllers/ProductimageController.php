<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\ProductImage;

class ProductimageController extends Controller
{  
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'image'=>'required|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img = 'ProImages'.time(). '.' .$data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/proImgs'),$img);
        }else{
            $img = 'avatar.png';
        }

        ProductImage::create([
            'product_id'=>$request->product_id,
            'image'=>$img
        ]);
        return redirect()->back()->with('message', 'Product Image created successfully!');

    }
   
    public function update(Request $request, $id)
    {
        $proImg = ProductImage::find($id);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
            $image = $request->file('image');
            $img = 'ProImages'. time() . '.' . $data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/proImgs'),$img);

            $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/proImgs')."/".$proImg->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else{
            $img = $proImg->image;
        }

        $proImg->product_id = $request->product_id;
        $proImg->image = $img;
        $proImg->save();
        return redirect()->back()->with('message', 'Product Image Updated successfully!');
    }

    public function destroy($id)
    {
        $img = ProductImage::find($id);
        $img->delete();
        $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/proImgs')."/".$img->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        return redirect()->back()->with('message', 'Product Image Deleted successfully!');
    }
}
