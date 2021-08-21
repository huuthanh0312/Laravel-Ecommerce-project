<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newOrder(){
        $title = 'Pending Order';
        $order = DB::table('orders')->where('status', 0)->get();
        return view('admin.order.pending', compact('order', 'title'));
    }

    public function viewOrder($id){
        $order = DB::table('orders')->join('users', 'orders.user_id','users.id')
                                    ->select('orders.*', 'users.name', 'users.phone')
                                    ->where('orders.id',$id)->first();
        $shipping = DB::table('shipping')->where('order_id', $id)->first();

        $details = DB::table('orders_details')->join('products', 'products.id', 'orders_details.product_id')
                                        ->select('orders_details.*', 'products.product_code', 'products.image_one')
                                        ->where('orders_details.order_id', $id)->get();
        return view('admin.order.view_order', compact('order','shipping', 'details'));
    }

    public function acceptPayment($id){
        DB::table('orders')->where('id', $id)->update(['status'=> 1]);
        $notification=array(
            'message'=>'Payment Accept Done',
            'alert-type'=>'success'
             );
        return Redirect()->route('admin.neworder')->with($notification);
    }

    public function canelPayment($id){
        DB::table('orders')->where('id', $id)->update(['status'=> 4]);
        $notification=array(
            'message'=>'Order Cancel',
            'alert-type'=>'success'
             );
        return Redirect()->route('admin.neworder')->with($notification);
    }

    public function deleveryProcess($id){
        DB::table('orders')->where('id', $id)->update(['status'=> 2]);
        $notification=array(
            'message'=>'Send To Delevery',
            'alert-type'=>'success'
             );
        return Redirect()->route('admin.accept.payment')->with($notification);
    }

    public function deleveryDone($id){
        $product = DB::table('orders_details')->where('order_id', $id)->get();

        foreach ($product as $row){
            DB::table('products')->where('id', $row->product_id)
                                ->update(['product_quantity' => DB::raw('product_quantity-'.$row->quantity)]);
        }

        DB::table('orders')->where('id', $id)->update(['status'=> 3]);
        $notification=array(
            'message'=>'Product Delevery Done',
            'alert-type'=>'success'
             );
        return Redirect()->route('admin.accept.payment')->with($notification);
    }
    
    public function viewAcceptPayment(){
        $title = 'Order Accept Payment';
        $order = DB::table('orders')->where('status', 1)->get();
        return view('admin.order.pending', compact('order', 'title'));
    }

    public function viewCancelOrder(){
        $title = 'Cancel Order';
        $order = DB::table('orders')->where('status', 4)->get();
        return view('admin.order.pending', compact('order', 'title'));
    }

    public function viewProcessOrder(){
        $title = 'Order Process';
        $order = DB::table('orders')->where('status', 2)->get();
        return view('admin.order.pending', compact('order', 'title'));
    }

    public function viewSuccessOrder(){
        $title = 'Order Success';
        $order = DB::table('orders')->where('status', 3)->get();
        return view('admin.order.pending', compact('order', 'title'));
    }

    // Admin Seo Setting Controller

    public function seo(){
        $seo =DB::table('seo')->first();
        return view('admin.coupon.seo', compact('seo'));
    }
    public function updateSeo(Request $request){
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['google_analytics'] = $request->google_analytics;
        $data['bing_analytics'] = $request->bing_analytics;
        DB::table('seo')->where('id', $request->id)->update($data);
        $notification=array(
            'message'=>'Seo Updated Successfully',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }
    
}
