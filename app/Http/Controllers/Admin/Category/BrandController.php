<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $brands = Brand::all();
        return view('admin.category.brand', compact('brands'));
    }

    public function storeBrand(Request $request){
        $validateData = $request->validate([
            'brand_name'=>'required|unique:brands|max:255',
            'brand_logo' => 'required|mimes:jpg,jpeg,png'
        ]);

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if($image){
            $image_name = date('dmy_H_s_i');   //name : 18_05_24_40_..
            $ext = strtolower($image->getClientOriginalExtension());  //tail .png .jpg.....
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->insert($data);
            $notification=array(
                'message'=>'Brand Inserted Successfully',
                'alert-type'=>'success'
                 );
            return Redirect()->back()->with($notification);

        } else{
            $brand = DB::table('brands')->insert($data);
            $notification=array(
                'message'=>'Its Done',
                'alert-type'=>'success'
                 );
            return Redirect()->back()->with($notification);
        }

    }

    public function deleteBrand($id){
        $data = DB::table('brands')->where('id',$id)->first();
        $image = $data->brand_logo;
        unlink($image);
        $brand = DB::table('brands')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Brands Deleted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function editBrand($id){
        $brand = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.edit_brand', compact('brand'));
    }

    public function updateBrand(Request $request, $id){
        $validateData = $request->validate([
            'brand_name'=>'required|max:255',
        ]);

        $old_brand_logo = $request->old_logo;

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if($image){
            unlink($old_brand_logo);
            $image_name = date('dmy_H_s_i');   //name : 18_05_24_40_..
            $ext = strtolower($image->getClientOriginalExtension());  //tail .png .jpg.....
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->where('id', $id)->update($data);
            $notification=array(
                'message'=>'Brand Updated Successfully',
                'alert-type'=>'success'
                 );
            return Redirect()->route('brands')->with($notification);

        } else{
            $brand = DB::table('brands')->where('id', $id)->update($data);
            $notification=array(
                'message'=>'Updated Without Images',
                'alert-type'=>'success'
                 );
            return Redirect()->route('brands')->with($notification);
        }
    }
}
