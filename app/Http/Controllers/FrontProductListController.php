<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Slider;
use App\Cart;
use App\ProductImage;
use App\Review;

class FrontProductListController extends Controller
{
    public function index(){
        $latestproducts =  Product::latest()
        ->where('section','=','Latest')
        ->limit(15)
        ->get();

        $featuredProducts =  Product::latest()
        ->where('section','=','Featured')
        ->limit(10)
        ->get();

        $bestProducts =  Product::latest()
        ->where('section','=','Best-Selling')
        ->limit(6)
        ->get();

        $bestbannerProducts =  Product::latest()
        ->where('section','=','Best-Selling-Banner')
        ->limit(1)
        ->get();

        $randomProducts =  Product::latest()
        ->where('section','=','Random')
        ->limit(6)
        ->get();
        
        //Random Active product for slider
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductsIds=[];
        foreach( $randomActiveProducts as $product){
            array_push(  $randomActiveProductsIds, $product->id);
        }
        //Random product except active products
        $randomItemProducts = Product::whereNotIn('id', $randomActiveProductsIds)->limit(6)->get();
        //homepage slider
        $sliders = Slider::latest()
                    ->where('section','=','Main-Slider')
                    ->limit(3)
                    ->get();

        $topBanners = Slider::latest()
                    ->where('section','=','Top-Banner')
                    ->limit(3)
                    ->get();

        $footerBanners = Slider::latest()
                    ->where('section','=','Footer-Banner')
                    ->limit(1)
                    ->get();

        $brandLogos = Slider::latest()
                    ->where('section','=','Brand-Logo')
                    ->limit(1)
                    ->get();

        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
        $cart = null;
        }

        return view('website.home',compact('latestproducts', 'featuredProducts', 'bestProducts', 'bestbannerProducts', 'randomProducts','randomActiveProducts','randomItemProducts', 'sliders', 'topBanners', 'footerBanners','brandLogos', 'cart'));
    }

    public function view($id){
        $product = Product::find($id);
        $reviews = Review::latest()
                          ->where('product_id', $product->id)
                          ->limit(5)
                          ->get();
        $productImages = ProductImage::latest()
                                    ->where('product_id', $product->id)
                                    ->limit(4)
                                    ->get();
        $productFromSameCategories = Product::inRandomOrder()
                                    ->where('category_id', $product->category_id)
                                    ->where('id','!=', $product->id)
                                    ->where('section','!=', 'Best-Selling-Banner')
                                    ->limit(6)
                                    ->get();
        // return $productImages;
        return view('website.productview',compact('product', 'reviews','productFromSameCategories', 'productImages'));
    }

    //Filter Products based on category
    public function categorisedProduct($name,Request $request){
        $category = Category::where ('slug',$name)->first();
        $categoryId = $category->id;
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        $slug = $name;
        //filter
        if($request->subcategory){
            $products = $this->filterProducts($request);
            $filterSubcategories = $this->getSubcategoriesId($request);
            return view('website.category',compact ('products', 'filterSubcategories', 'subcategories', 'slug','categoryId'));
            
        }

        elseif($request->min || $request->max){
            $products = $this->filterByPrice($request);
            return view('website.category',compact ('products', 'subcategories', 'slug', 'categoryId'));
        } 

        elseif($request->price_range){
            $products = $this->filterByPriceRange($request);
            return view('website.category',compact ('products', 'subcategories','slug', 'categoryId'));
        } 

        else{
            $products = Product::where ('category_id', $category->id)->get();
            return view('website.category',compact ('products', 'subcategories', 'slug', 'categoryId'));
        }

    }

    //Filter By Subcategory Function
    public function filterProducts(Request $request){
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        $products = Product::whereIn ('subcategory_id', $subId)->get();
        return $products;
    }

    //Filter click remember Function
    public function getSubcategoriesId(Request $request){
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        return $subId;
    }

    //Filter by price Range for categorised product
    public function filterByPriceRange(Request $request){
       
        $categoryId = $request->categoryId;
        $minPrice =  $request->minPrice;
        $maxPrice =  $request->maxPrice;

        if($request->price_range){
            $price_range = explode('-', $request->price_range);
            $minPrice = $price_range[0];
            $maxPrice = $price_range[1];
        }
        
        $products = Product::whereBetween ('price',[$minPrice, $maxPrice] )
                    ->where('category_id', $categoryId)
                    ->get();
        return $products;
    }

    //Filter by customer's price
    public function filterByPrice(Request $request){
        // dd($request);
        $categoryId = $request->categoryId;
        $products = Product::whereBetween ('price',[$request->min, $request->max] )
                    ->where('category_id', $categoryId)
                    ->get();
        return $products;
    }

    //Search Product
    public function moreProducts(Request $request){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
        $cart = null;
        }

        if($request->search){
            $products = Product::where('name','like','%'.$request->search.'%')
            ->orWhere('description','like','%'.$request->search.'%')
            ->orWhere('price','like','%'.$request->search.'%')
            ->paginate(50);

            $bestProducts =  Product::latest()
            ->where('section','=','Best-Selling')
            ->limit(6)
            ->get();
            return view('website.shop',compact('products', 'cart', 'bestProducts'));
        }

        elseif($request->price_range){
            $products = $this->ProductsByPriceRange($request);
            $bestProducts =  Product::latest()
            ->where('section','=','Best-Selling')
            ->limit(6)
            ->get();
            return view('website.shop',compact ('products', 'cart', 'bestProducts'));
        } 

        $products = Product::latest()->paginate(12);
        $bestProducts =  Product::latest()
        ->where('section','=','Best-Selling')
        ->limit(6)
        ->get();
        return view('website.shop',compact('products', 'cart', 'bestProducts'));
    }

    //Filter by price Range for all products
    public function ProductsByPriceRange(Request $request){
       
        $minPrice =  $request->minPrice;
        $maxPrice =  $request->maxPrice;

        if($request->price_range){
            $price_range = explode('-', $request->price_range);
            $minPrice = $price_range[0];
            $maxPrice = $price_range[1];
        }
        
        $products = Product::whereBetween ('price',[$minPrice, $maxPrice] )
        ->paginate(4);
        return $products;
    }
   
}
