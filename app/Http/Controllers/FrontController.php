<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FrontController extends Controller
{
    public function storeNewslater(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:newslaters|max:255',
        ]);
        $data = array();
        $data['email'] = $request->email;
        DB::table('newslaters')->insert($data);
        $notification=array(
            'message'=>'Thanks For Subcribing',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function orderTracking(Request $request){
        $code = $request->code;
        $track = DB::table('orders')->where('status_code', $code)->first();
        if($track){
            return view('pages.tracking', compact('track'));
        }else{
            $notification=array(
                'message'=>'Status Code Invalid',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function successOrderList(){
        $order = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)
                           ->orderBy('id', 'desc')->limit(5)->get();

        return view('pages.return_order', compact('order'));
    }

    public function requestReturn($id) {
        DB::table('orders')->where('id', $id)->update(['return_order'=> 1]);
        $notification=array(
            'message'=>'Order Request Done',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //Search Product
    public function search(Request $request){
        $item = $request->search;
        $product = DB::table('products')->where('product_name','LIKE',"%$item%")->paginate(20);
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('pages.search', compact('product','categories', 'brands'));

    }
}
