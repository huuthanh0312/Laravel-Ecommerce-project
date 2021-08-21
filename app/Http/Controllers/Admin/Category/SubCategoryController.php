<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Subcategory;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')
            ->join('categories', 'categories.id', 'subcategories.category_id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        return view('admin.category.subcategory', compact('category','subcategory'));
    }

    public function storeSubcategory(Request $request){
        $validateData = $request->validate([
            'category_id' =>'required',
            'subcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->insert($data);

        $notification=array(
            'message'=>'SubCategory Inserted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function deleteSubcategory($id) {
        DB::table('subcategories')->where('id', $id)->delete();
        $notification=array(
            'message'=>'SubCategory Deleted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function editSubcategory($id){

        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->where('id', $id)->first();
        return view('admin.category.edit_subcategory', compact('category','subcategory'));
    }

    public function updateSubcategory(Request $request, $id){
        $validateData = $request->validate([
            'category_id' =>'required',
            'subcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id',$id)->update($data);

        $notification=array(
            'message'=>'SubCategory Updated Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->route('subcategories')->with($notification);
    }
}
