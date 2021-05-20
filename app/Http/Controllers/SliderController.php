<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Slider;

class SliderController extends Controller
{
    
    public function index()
    {
        $sliders = Slider::get();
        return view('product.slider',compact('sliders'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'required|mimes:jpeg,png',
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img = $data['section'].time(). '.' .$data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/sliderImg'),$img);
        }else{
            $img = 'avatar.png';
        }
        Slider::create([
            'name'=>$request->name,
            'tagline'=>$request->tagline,
            'section'=>$request->section,
            'image'=>$img
        ]);
        return redirect()->back()->with('message', 'Slider created successfully!');

    }
   
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        
        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
            $image = $request->file('image');
            $img = $data['section'] . time() . '.' . $data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'imgfiles/sliderImg'),$img);

            $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/sliderImg')."/".$slider->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else{
            $img = $slider->image;
        }

        $slider->name = $request->name;
        $slider->tagline = $request->tagline;
        $slider->section = $request->section;
        $slider->image=$img;
        $slider->save();
        return redirect()->back()->with('message', 'Slider Updated successfully!');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        $image_path = public_path(env('REL_PUB_FOLD').'imgfiles/sliderImg')."/".$slider->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        return redirect()->back()->with('message', 'Slider Deleted successfully!');
    }
}
