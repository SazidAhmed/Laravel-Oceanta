<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Order;
use App\GuestOrder;
use App\User;
use App\Mail\Sendmail;

use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CartController extends Controller
{
    public function addToCart(Product $product){
        //  dd($product);
        //if session has cart then get the cart
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }//If session has no cart then instantiate a new cart
        else{
           $cart = new Cart();
        }
        $cart->add($product);
        // dd($cart);

        session()->put('cart',$cart);
        //  dd($cart);
        return redirect()->back()->with('message', 'Product Has Been Added To Cart');
    }

    public function showCart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
           $cart = null;
        }
        // dd($cart);
        // dd($cart->items);
        return view('website.cart',compact('cart'));
    }

    public function showCartInNav(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
           $cart = null;
        }
        // dd($cart);
        // dd($cart->items);
        return response()->json($cart);
    }

    public function updateCart(Request $request, Product $product){
        $request->validate(['qty'=>'required|numeric|min:1']);

        $cart = new Cart(session()->get('cart'));

        $cart->updateQty($product->id, $request->qty);
        
        session()->put('cart',$cart);
        // dd($cart);
        return redirect()->back()->with('message', 'Cart Has Been Updated ');
    }

    public function removeCart(Product $product){
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if($cart->totalQty<=0){
            session()->forget('cart');
        }
        else{
            session()->put('cart',$cart);
        }
        return redirect()->back()->with('message', 'Product Has Been Removed ');
    }
    //checkout
    public function checkout($amount){

        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
           $cart = null;
        }
        return view('website.checkout',compact('amount', 'cart'));
    }
    //Place Order for registered user
    // public function Order(Request $request){
    //     if(session()->has('cart')){
    //         auth()->user()->orders()->create([
    //             'cart'=>serialize(session()->get('cart'))
    //         ]);
    //         session()->forget('cart');
    //         return redirect()->to('/')->with('message', 'Order Has Been Placed successfully ');
    //     }
    //     else{
    //         return redirect()->back()->with('message', 'Please Try Again');
    //     }
    // }

    //Place Order for registered user
    public function placeOrder(Request $request){

        // $name =  $request->name;
        $data['user_id'] = $request->user_id;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['note'] = $request->note;
        // dd($request);
        if(session()->has('cart')){
            Order::create([
                'cart'=>serialize(session()->get('cart')),
                'user_id' => $data['user_id'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'note' => $data['note'],
            ]);

            $cart = new Cart(session()->get('cart'));
            session()->forget('cart');
            return redirect()->to('/')->with('message', 'Order Has Been Placed successfully ');
        }
        else{
            return redirect()->back()->with('message', 'Please Try Again');
        }
    }
    
    //Place Order for guest
    public function guestOrder(Request $request){

        // $name =  $request->name;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['note'] = $request->note;
        // dd($request);
        if(session()->has('cart')){
            GuestOrder::create([
                'cart'=>serialize(session()->get('cart')),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'note' => $data['note'],
            ]);

            $cart = new Cart(session()->get('cart'));
            foreach($cart->items as $product){
                $id=$product['id'];
                $stock=$product['stock'];
                // dd($stock);
                // $pro = Product::where('id','=',$id)->get();
                Product::where('id', $id)->update(['stock' => $stock]);
            }
            
            session()->forget('cart');
            return redirect()->to('/')->with('message', 'Order Has Been Placed successfully ');
        }
        else{
            return redirect()->back()->with('message', 'Please Try Again');
        }
    }

    //Customer Panel 
    public function customePanel(){
        // $orders = auth()->user()->orders;
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('product.customerPanel',compact('orders'));
    }
    //Customer Panel Invoice
    public function customerInvoice($userid, $orderid){
        $user = User::find($userid);
        $orders = $user->orders->where('id',$orderid);
        $carts = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        return view('product.invoice',compact('carts'));
    }

    //Show registered customers order in AdminPanel
    public function allOrder(){
        $allOrders = Order::latest()->get();
        return view('product.allorder',compact('allOrders'));

    }

    public function viewUserOrder($userid, $orderid){
        $user = User::find($userid);
        $orders = $user->orders->where('id',$orderid);
        $carts = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        return view('product.vieworder',compact('carts'));
    }

    //Show Guest customers order in AdminPanel
     public function allGuestOrder(){
        $allGuestOrders = GuestOrder::latest()->get();
        // return  $allGuestOrders;
        return view('product.guestorder',compact('allGuestOrders'));
    }

    public function viewGuestOrder($orderid){
        $orders = GuestOrder::latest()->where('id',$orderid)->get();
        $carts = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        // return $carts;
        return view('product.vieworder',compact('carts'));
    }

    //Delete Guest Order
    public function DeleteGuestOrder($id)
    {
        $order = GuestOrder::find($id);
        $order->delete();
        return redirect()->back()->with('message', 'Order Deleted successfully!');
    }

    //update guest Customer Order
    public function updateGuestOrder(Request $request, $id)
    {
        $order = GuestOrder::find($id);
        $order->status = $request->input('status');
        // dd($request->all());
        $order->save();
        return redirect()->back()->with('message','Order Status Updated Successfully');
    }

     //update registered Customer Order
     public function updateOrder(Request $request, $id)
     {
         $order = Order::find($id);
         $order->status = $request->input('status');
        //  dd($request->all());
         $order->save();
         return redirect()->back()->with('message','User Updated Successfully');
     }

     
    //Delete registered user order
    public function DeleteOrder($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('message', 'Order Deleted successfully!');
    }
}
