<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProducts(){

        $product = Product::orderBy('created_at','DESC')->get();

        return view('homepage',compact('product'));
    }

    public function saveProduct(Request $request){

        if(!isset($request->p_name) || !isset($request->unit_price) || !isset($request->qty)){

            return back()->with('danger',"Please fill the required fields !!");

        }else {

            $newProduct = new Product();
            $newProduct->name = $request->p_name;
            $newProduct->unit_price = $request->unit_price;
            $newProduct->qty = $request->qty;
            $newProduct->description = $request->description;
            $newProduct->save();

            return back()->with('status',"Added to Cart");

        }

    }

    public function getProductCount(){

        $cart = Cart::all();

        return response()->json([
            "product_count" => count($cart)
        ]);

    }

    public function deleteProduct($id){

        $product = Product::where('id',$id)->get()->first();

        if($product){

            $product->delete();

            return back()->with("status" , "Successfully Deleted the Product");

        }else {

            return back()->with("danger" , "Cannot find the Product !");

        }

    }

    public function updateProduct(Request $request){

        if($request->unit_price_edit < 1){
            return back()->with("danger","Invalid Unit Price !");

        }else if($request->qty_id_edit < 1){
            return back()->with("danger" , "Invalid Product Qty !");

        }else {

            $product = Product::where('id',$request->product_id)->get()->first();
            if($product){

                $product->name = $request->p_name_edit;
                $product->unit_price = $request->unit_price_edit;
                $product->description = $request->description_edit;
                $product->qty = $request->qty_id_edit;
                $product->save();

                return back()->with("status" , "Product Updated Successful");

            }else {
                return back()->with("danger" , "Cannot find the Product !");
            }
        }

    }

    public function viewCart(){

        $carts = Cart::orderBy('created_at' , 'DESC')->get();

        return view('cart_view',compact('carts'));

    }

    public function addToCart($id){

        $product = Product::where('id',$id)->get()->first();

        if($product){

            if($product->qty > 0){

                $product->qty = $product->qty-1;
                $product->save();

                $cart = new Cart();
                $cart->product = $product->name;
                $cart->price = $product->unit_price;
                $cart->qty = 1;
                $cart->save();

                return back()->with("status" , "Added to Cart");

            }else {
                return back()->with("danger" , "No Inventory for the Product !");
            }

        }else {
            return back()->with("danger" , "Cannot find the Product !");
        }

    }

    public function deleteCartItem($id){

        $cart = Cart::where('id',$id)->get()->first();

        $product = Product::where('name',$cart->product)->get()->first();

        if($product){
            $product->qty = $product->qty+1;
            $product->save();
        }

        $cart->delete();

        return back()->with('status' , "Item Deleted");

    }

    public function deleteCartAll(){

        $cart = Cart::all();
        foreach($cart as $ca){
            $ca->delete();
        }

        return back()->with("status" , "Cart Cleared !");

    }

}
