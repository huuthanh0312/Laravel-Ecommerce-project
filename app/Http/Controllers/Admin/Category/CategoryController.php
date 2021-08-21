<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $category = Category::all();
        return view('admin.category.category',compact('category'));
    }

    public function storeCategory(Request $request){
        $validateData = $request->validate([
            'category_name'=>'required|unique:categories|max:255'
        ]);

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification=array(
            'message'=>'Category Inserted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function deleteCategory($id){
        DB::table('categories')->where('id',$id)->delete();
        //Category::find($id)->delete();
        $notification=array(
            'message'=>'Category Deleted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function editCategory($id){
        $category = DB::table('categories')->where('id',$id)->first();
        //$category = Category::find($id)->get();
        return view('admin/category.edit_category', compact('category'));
    }

    public function updateCategory(Request $request, $id){
        $validateData = $request->validate([
            'category_name'=>'required|max:255'
        ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        $update = DB::table('categories')->where('id',$id)->update($data);
        if($update){
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('categories')->with($notification);
        } else{
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return Redirect()->route('categories')->with($notification);
        }

    }


}
