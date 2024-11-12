<?php

 namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

 class CartManagement{
    //add item
    static public function addItemToCart($product_id){
        $cart_items = self::getCartItemsFromCookie();
       $existing_item= null;

       foreach($cart_items as $key =>$item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
       }
       if($existing_item !==null){
        $cart_items[$existing_item]['quantity']++;
        $cart_items[$existing_item]['total_amount']=$cart_items[$existing_item]['quantity'] * 
        $cart_items[$existing_item]['unit_amount'];
       }else{
        $product = Product::where('id',$product_id)->first(['id','name','price','images']);
         if($product){
            $cart_items[]=[
                'product_id'=>$product->id,
                'name'=>$product->name,
                'image'=>$product->images[0],  
                'quantity'=>1,
                'unit_amount'=>$product->price,
                'total_amount'=>$product->price,
               
            ];
        }
       }
       self::addCartItemsToCookie($cart_items);
       return count($cart_items);
    }
    //add item with qty 
    static public function addItemToCartWithQty($product_id,$qty = 1){
        $cart_items = self::getCartItemsFromCookie();
       $existing_item= null;

       foreach($cart_items as $key =>$item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
       }
       if($existing_item !==null){
        $cart_items[$existing_item]['quantity'] = $qty;
        $cart_items[$existing_item]['total_amount']=$cart_items[$existing_item]['quantity'] * 
        $cart_items[$existing_item]['unit_amount'];
       }else{
        $product = Product::where('id',$product_id)->first(['id','name','price','images']);
         if($product){
            $cart_items[]=[
                'product_id'=>$product->id,
                'name'=>$product->name,
                'image'=>$product->images[0],  
                'quantity'=>$qty,
                'unit_amount'=>$product->price,
                'total_amount'=>$product->price,
               
            ];
        }
       }
       self::addCartItemsToCookie($cart_items);
       return count($cart_items);
    }

    //remove item
    static public function removeCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach($cart_items as $key =>$item){
            if($item['product_id'] == $product_id){
                unset($cart_items[$key]);
            }
        }
        self ::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    //add cart item ti cookies
    static public function addCartItemsToCookie($cart_item){
        Cookie::queue('cart_items', json_encode($cart_item), 60*24*30);
    }

    //clear cart item from cookies
static public function clearCartItemsFromCookie(){
    Cookie::queue(Cookie::forget('cart_items'));
}
    //get all cart item from cookies

    static public function getCartItemsFromCookie(){
       $cart_items =json_decode(Cookie::get('cart_items'), true);
       if(!$cart_items){
           return [];
       }
       return $cart_items;
    }

    //increment item quantutuy
    static public function incrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * 
                $cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    //decrement item quantity
    static public function decrementQuantitiyToCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();
        foreach($cart_items as $key =>$item){
            if($item['product_id'] == $product_id){
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] *
                    $cart_items[$key]['unit_amount'];
                }
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;  
    }

    //calculate grand total
    static public function calculateGrandTotal($items){
        return array_sum(array_column($items, 'total_amount'));
    }
 }
