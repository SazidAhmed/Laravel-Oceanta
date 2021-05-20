<?php

namespace App;

class Cart
{
	public $items = [];
	public $totalQty;
	public $totalPrice;
	public $stock;

  public function __construct($cart=null){
    if($cart){
			$this->items = $cart->items;
			$this->totalPrice = $cart->totalPrice;
			$this->totalQty = $cart->totalQty;
			// $this->stock = $cart->stock;

		}else{
			$this->items=[];
			$this->totalQty=0;
			$this->totalPrice=0;
			// $this->stock = 0;
		}
  }

  //Cart Item
  public function add($product){
    $item = [
			'id'=>$product->id,
			'name'=>$product->name,
			'price'=>$product->price,
			'qty'=>0,
			'stock'=>$product->stock,
			'image'=>$product->image
		];
    //Creating Cart
    //if product is not in cart items
    if(!array_key_exists($product->id,$this->items)){
			$this->items[$product->id] = $item;
			$this->totalQty+=1;
			$this->totalPrice+=$product->price;
			$this->stock= $product->stock - 1;
		} //if product is already in cart items
    else{
			$this->totalQty+=1;
			$this->totalPrice+=$product->price;
			$this->stock = $this->items[$product->id]['stock'] - $this->items[$product->id]['qty'];
    }
		$this->items[$product->id]['qty']+=1;
		$this->items[$product->id]['stock']-=1;
   
	}
	
	public function updateQty($id, $qty){
		$this->totalQty-=$this->items[$id]['qty'];
		$this->totalPrice-=$this->items[$id]['price']*$this->items[$id]['qty'];
		$this->stock+=$this->items[$id]['stock'];
		//add item with new qty
		$this->items[$id]['qty']=$qty;
		
		$this->totalQty+=$qty;
		$this->totalPrice+=$this->items[$id]['price']*$qty;
		
	}

	public function remove($id){
		if(array_key_exists($id,$this->items)){
			$this->totalQty-=$this->items[$id]['qty'];
			$this->totalPrice-=$this->items[$id]['price']*$this->items[$id]['qty'];
			unset($this->items[$id]);
		}
	}
}
