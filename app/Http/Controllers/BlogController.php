<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BlogController extends Controller
{
    public function blog(){
        $post = DB::table('posts')
                    ->join('post_category', 'post_category.id', 'posts.category_id')
                    ->select('posts.*','post_category.category_name_en','post_category.category_name_vi')
                    ->get();
        return view('pages.blog', compact('post'));
    }

    public function english(){
        Session::get('lang');
        Session()->forget('lang');
        Session()->put('lang','english');
        return redirect()->back();
    }

    public function vietnam(){
        Session::get('lang');
        Session()->forget('lang');
        Session()->put('lang','vietnam');
        return redirect()->back();
    }

    public function singleBlog($id){
        // $post= DB::table('posts')
        //             ->join('post_category', 'post_category.id', 'posts.category_id')
        //             ->select('posts.*', 'post_category.category_name_en', 'post_category.category_name_vi')
        //             ->where('id', $id)->first();
        $post= DB::table('posts')->where('id', $id)->first();
        return view('pages.blog_single', compact('post'));
    }
}
