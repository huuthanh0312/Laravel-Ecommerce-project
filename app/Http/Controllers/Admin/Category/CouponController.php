<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Coupon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $coupons = DB::table('coupons')->get();
        return view('admin.coupon.coupon', compact('coupons'));
    }

    public function storeCoupon(Request $request){
        $validateData = $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);
        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function deleteCoupon($id) {
        DB::table('coupons')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function editCoupon($id) {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    public function updateCoupon(Request $request, $id){
        $validateData = $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.coupon')->with($notification);
    }


    //Newslater Controller
    public function Newslater(){
        $newslaters = DB::table('newslaters')->get();
        return view('admin.coupon.newslater', compact('newslaters'));

    }
    public function deleteNewslater($id){
        DB::table('newslaters')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Newslater Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function deleteall(Request $request){
        $ids = $request->get('ids');

        $dbs = DB::delete('delete from newslaters where id in('.implode(", ", $ids).')');

        $notification = array(
            'message' => 'All Data  Deleted Successfully',
            'alert-type' => 'info'
        );
        return Redirect()->back()->with($notification);
    }
}
