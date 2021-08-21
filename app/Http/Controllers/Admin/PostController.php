<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // function blog category post
    public function blogCatList(){
        $blogcat = DB::table('post_category')->get();
        return view('admin.blog.category.index', compact('blogcat'));
    }

    public function blogCatStore(Request $request){
        $validateData =  $request->validate([
            'category_name_en' => 'required|unique:post_category|max:255',
            'category_name_vi' => 'required|unique:post_category|max:255',
        ]);
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_vi'] = $request->category_name_vi;
        DB::table('post_category')->insert($data);
        $notification=array(
            'message'=>'Blog Category Inserted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }
    
    public function blogCatDelete($id){
        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Blog Category Deleted Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function blogCatEdit($id){
        $blogcat = DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.category.edit', compact('blogcat'));
    }

    public function blogCatUpdate(Request $request, $id){
        $validateData =  $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_vi' => 'required|max:255',
        ]);

        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_vi'] = $request->category_name_vi;
        DB::table('post_category')->ưhere('id',$id)->update($data);
        $notification=array(
            'message'=>'Blog Category Updated Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->route('list.blog.category')->with($notification);
    }

    // function post
    public function index() {
        $post = DB::table('posts')
                    ->join('post_category', 'posts.category_id', 'post_category.id')
                    ->select('posts.*', 'post_category.category_name_en', 'post_category.category_name_vi')
                    ->get();
        return view('admin.blog.index', compact('post'));
    }

    public function createPost(){
        $blogcategory = DB::table('post_category')->get();
        return view('admin.blog.create',compact('blogcategory'));
    }

    public function storePost(Request $request){
        $validateData =  $request->validate([
            'post_title_en' => 'required|max:255',
            'post_title_vi' => 'required|max:255',
            'category_id' => 'required',
            'details_en' => 'required|max:255',
            'details_vi' => 'required|max:255',
        ]);
        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_vi'] = $request->post_title_vi;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_vi'] = $request->details_vi;

        $post_image = $request->file('post_image');
        if($post_image){
            $post_image_name = hexdec(uniqid()).'.'.strtolower($post_image->getClientOriginalExtension());
            Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
            $data['post_image'] = 'public/media/post/'.$post_image_name;

            $product = DB::table('posts')->insert($data);
            $notification = array(
                'message' => 'Post Inserted Successfully',
                'alert-type' => 'success',
            );
            return Redirect()->back()->with($notification);
        }    
    }

    public function deletePost($id){
        $post = DB::table('posts')->where('id', $id)->first();
        $post_image = $post->post_image;

        unlink($post_image);
        DB::table('posts')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function editPost($id){

        $post = DB::table('posts')->where('id', $id)->first();
        return view('admin.blog.edit', compact('post'));
    }

    public function updatePost(Request $request, $id){
        $validateData =  $request->validate([
            'post_title_en' => 'required|max:255',
            'post_title_vi' => 'required|max:255',
            'category_id' => 'required',
            'details_en' => 'required|max:255',
            'details_vi' => 'required|max:255',
        ]);
        $old_post_image = $request->old_post_image;

        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_vi'] = $request->post_title_vi;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_vi'] = $request->details_vi;

        $post_image = $request->file('post_image');
        if($post_image){
            unlink($old_post_image);
            $post_image_name = hexdec(uniqid()).'.'.strtolower($post_image->getClientOriginalExtension());
            Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
            $data['post_image'] = 'public/media/post/'.$post_image_name;
        }
        $product = DB::table('posts')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('all.blogpost')->with($notification); 
    }
}
