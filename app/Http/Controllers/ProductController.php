<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;

class ProductController extends Controller
{
    public function detailShowProduct($id, $productName){
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

        return view('pages.product_details', compact('product','product_color','product_size'));
    }

    public function addProduct(Request $request, $id){
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
            'message'=>'Product Successfully Added',
            'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification); 
        }else{
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
            'message'=>'Product Successfully Added',
            'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification); 
        }
    }
    public function viewSubCatProduct($id) {
        $catname = DB::table('subcategories')->where('id', $id)->first();
        $products = DB::table('products')
                        ->where('products.subcategory_id',$id)
                        ->paginate(10);
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('pages.all_products', compact('products', 'categories','brands', 'catname'));
    }

    public function viewCatProduct($id) {
        $catname = DB::table('categories')->where('id', $id)->first();
        $products = DB::table('products')
                        ->where('products.category_id',$id)
                        ->paginate(10);
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('pages.all_category', compact('products', 'categories','brands', 'catname'));
    }
}
