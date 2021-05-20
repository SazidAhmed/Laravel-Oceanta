<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class reviewController extends Controller
{

    public function index(Review $model)
    {
        return view('product.review', ['reviews' => $model->paginate(10)]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'name'=>'required',
            'comment'=>'required',
            'product_id'=>'required'
        ]);
        Review::create($request->all());
        return redirect()->back()->with('message', 'Product Review Has Been Submitted successfully!');
    }

    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        return redirect()->back()->with('message', 'Product Review Has Been Deleted successfully!');
    }
}
