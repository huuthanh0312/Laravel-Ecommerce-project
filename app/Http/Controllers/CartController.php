<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Cart;
use Auth;
use Session;

class CartController extends Controller
{

    public function addCart($id){
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();

        if($product->discount_price == null){
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return Response::json(['success'=>'Successfully Add On Your Cart']);
        }else{
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return Response::json(['success'=>'Successfully Add On Your Cart']);
        }
    }

    public function check(){
        $content = Cart::Content();
        return response()->json($content);
    }

    public function showCart(){
        $cart = Cart::Content();
        return view('pages.cart', compact('cart'));
    }

    public function removeCart($rowId){
        Cart::remove($rowId);
        
        $notification=array(
            'message'=>'Product Removed From Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function updateCart(Request $request){
        $rowId = $request->productid;
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        $notification=array(
            'message'=>'Product Quantity Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function viewProduct($id){
        $product = DB::table('products')
                    ->join('categories', 'categories.id', 'products.category_id')
                    ->join('brands', 'brands.id', 'products.brand_id')
                    ->join('subcategories', 'subcategories.id', 'products.subcategory_id')
                    ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                    ->where('products.id',$id)
                    ->first();

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        return response::json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function insertCart(Request $request){
        $id = $request->product_id;
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();

        if($product->discount_price == null){
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
                'message'=>'Product Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
                'message'=>'Product Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function checkout() {
        if(Auth::check()) {
            $cart = Cart::Content();
            return view('pages.checkout', compact('cart'));
        }else {
            $notification=array(
                'message'=>'At First Your Login',
                'alert-type'=>'warning'
            );
            return Redirect()->route('login')->with($notification);
        }
    }

    public function applyCoupon(Request $request) {
        $coupon = $request->coupon;

        $check = DB::table('coupons')->where('coupon',$coupon)->first();
        if($check){
            Session::put('coupon',[
                'name'=>$check->coupon,
                'discount' =>$check->discount,
                'balance' => Cart::Subtotal()-$check->discount,
            ]);
            $notification=array(
                'message'=>'Successfully Coupon Applied',
                'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification); 
        }else{
            $notification=array(
                'message'=>'Invalid Coupon',
                'alert-type'=>'error'
                    );
                return Redirect()->back()->with($notification); 
        }
    }

    public function removeCoupon(){
        Session::forget('coupon');
        $notification=array(
        'message'=>'Coupon Removed Successfully',
        'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification); 
    }

    public function paymentPage() {
        $cart = Cart::Content();
        return view('pages.payment', compact('cart'));
    }
}
