<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;
class SubcategoryController extends Controller
{
    public function index(Subcategory $model)
    {
        // return view('product.subcategory', ['subcategories' => $model->paginate(10)]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'name'=>'required|min:2',
            'category_id'=>'required'
        ]);
        Subcategory::create($request->all());
        return redirect()->back()->with('message', 'Product Subcategory Has Been Created successfully!');
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->update($request->all());
        return redirect()->back()->with('message', 'Product Subcategory Has Been Updated successfully!');
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect()->back()->with('message', 'Product Subcategory Has Been Deleted successfully!');
    }
}
