<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function returnRequest(){
        $title = 'Return Order List';
        $order = DB::table('orders')->where('return_order', 1)->get();
        return view('admin.request.request', compact('order', 'title'));
    }

    public function approveRequest($id){
        DB::table('orders')->where('id', $id)->update(['return_order'=> 2]);
        $notification=array(
            'message'=>'Order Request Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allRequest(){
        $title = 'All Return Order Success';
        $order = DB::table('orders')->where('return_order', 2)->get();
        return view('admin.request.request', compact('order', 'title'));
    }
}
