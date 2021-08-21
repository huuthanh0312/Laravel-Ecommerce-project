<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $product = DB::table('products')
                        ->join('categories', 'products.category_id', 'categories.id')
                        ->join('brands', 'products.brand_id', 'brands.id')
                        ->select('products.*','categories.category_name','brands.brand_name')
                        ->get();
        return view('admin.product.index', compact('product'));
    }

    public function createProduct(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.create', compact('category', 'brand'));
    }

    public function getSubcategory($category_id){
        $cat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($cat);
    }

    public function storeProduct(Request $request){
        $validateData = $request->validate([
            'product_name'=>'required|max:255',
            'product_code'=>'required|max:255',
            'product_quantity'=>'required|max:255',
            'image_one' => 'mimes:jpg,jpeg,png',
            'image_two' => 'mimes:jpg,jpeg,png',
            'image_three' => 'mimes:jpg,jpeg,png'
        ]);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['hot_new'] = $request->hot_new;
        $data['status'] = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if($image_one && $image_two && $image_three){

            $image_one_name = hexdec(uniqid()).'.'.strtolower($image_one->getClientOriginalExtension());
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_one'] = 'public/media/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.strtolower($image_two->getClientOriginalExtension());
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_two'] = 'public/media/product/'.$image_two_name;

            $image_three_name = hexdec(uniqid()).'.'.strtolower($image_three->getClientOriginalExtension());
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_three'] = 'public/media/product/'.$image_three_name;

            $product = DB::table('products')->insert($data);
            $notification = array(
                'message' => 'Product Inserted Successfully',
                'alert-type' => 'success',
            );
            return Redirect()->back()->with($notification);

        }
    }

    public function inactive($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        $notification = array(
            'message' => 'Product Successfully Inactive',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function active($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        $notification = array(
            'message' => 'Product Successfully Active',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function deleteProduct($id) {
        $product = DB::table('products')->where('id', $id)->first();
        $image_one = $product->image_one;
        $image_two = $product->image_two;
        $image_three = $product->image_three;

        unlink($image_one);
        unlink($image_two);
        unlink($image_three);

        DB::table('products')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Product Successfully Active',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function viewProduct($id){
        $product = DB::table('products')
                        ->join('categories', 'categories.id','products.category_id')
                        ->join('subcategories', 'subcategories.id','products.subcategory_id')
                        ->join('brands', 'brands.id','products.brand_id')
                        ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                        ->where('products.id', $id)
                        ->first();
        return view('admin.product.show', compact('product'));
    }

    public function editProduct($id){
        $product = DB::table('products')->where('id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }

    public function updateProductWithoutPhoto(Request $request, $id){
        $validateData = $request->validate([
            'product_name'=>'required|max:255',
            'product_code'=>'required|max:255',
            'product_quantity'=>'required|max:255',
        ]);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code; 
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['hot_new'] = $request->hot_new;

        
        $product = DB::table('products')->where('id',$id)->update($data);
        $notification = array(
            'message' => 'Product Successfully Updated',
            'alert-type' => 'success',
        );
        return Redirect()->route('all.product')->with($notification);

    }

    public function updateProductPhoto(Request $request, $id){
        $validateData = $request->validate([
            'image_one' => 'mimes:jpg,jpeg,png',
            'image_two' => 'mimes:jpg,jpeg,png',
            'image_three' => 'mimes:jpg,jpeg,png'
        ]);
        $old_image_one = $request->old_image_one;
        $old_image_two = $request->old_image_two;
        $old_image_three = $request->old_image_three;

        $data = array();

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if($image_one){
            unlink($old_image_one);

            $image_one_name = hexdec(uniqid()).'.'.strtolower($image_one->getClientOriginalExtension());
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_one'] = 'public/media/product/'.$image_one_name;

            $product = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Image One Successfully Updated',
                'alert-type' => 'success',
            );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_two){
            unlink($old_image_two);


            $image_two_name = hexdec(uniqid()).'.'.strtolower($image_two->getClientOriginalExtension());
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_two'] = 'public/media/product/'.$image_two_name;

            $product = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Image Two Successfully Updated',
                'alert-type' => 'success',
            );
            return Redirect()->route('all.product')->with($notification);
        }
        
        if($image_three){
            unlink($old_image_three);

            $image_three_name = hexdec(uniqid()).'.'.strtolower($image_three->getClientOriginalExtension());
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_three'] = 'public/media/product/'.$image_three_name;

            $product = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Image Three Successfully Updated',
                'alert-type' => 'success',
            );
            return Redirect()->route('all.product')->with($notification);
        }
    }

    //Admin Stock Product Return
    public function productStock() {
        $product = DB::table('products')
                        ->join('categories', 'products.category_id', 'categories.id')
                        ->join('brands', 'products.brand_id', 'brands.id')
                        ->select('products.*','categories.category_name','brands.brand_name')
                        ->get();
        return view('admin.stock.stock', compact('product'));
    }
}
