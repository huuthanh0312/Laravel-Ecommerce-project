<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allUserRole(){
        $user = DB::table('admins')->where('type', 2)->get();
        return view('admin.role.all_role', compact('user'));
    }

    public function addUserRole(){
        return view('admin.role.create_role');
    }

    public function storeUserRole(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['product'] = $request->product;
        $data['coupon'] = $request->coupon;
        $data['order'] = $request->order;
        $data['blog'] = $request->blog;
        $data['report'] = $request->report;
        $data['return'] = $request->return;
        $data['stock'] = $request->stock;
        $data['contact'] = $request->contact;
        $data['comment'] = $request->comment;
        $data['setting'] = $request->setting;
        $data['role'] = $request->role;
        $data['other'] = $request->other;
        $data['type'] = 2;

        DB::table('admins')->insert($data);
        $notification = array(
            'message' => 'Child Admin Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.all.user')->with($notification);
    }

    public function deleteUserRole($id){
        DB::table('admins')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Child Admin Deleted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function editUserRole($id){
        $user = DB::table('admins')->where('id', $id)->first();
        return view('admin.role.edit_role', compact('user'));
    }

    public function updateUserRole(Request $request, $id){

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['product'] = $request->product;
        $data['coupon'] = $request->coupon;
        $data['order'] = $request->order;
        $data['blog'] = $request->blog;
        $data['report'] = $request->report;
        $data['return'] = $request->return;
        $data['stock'] = $request->stock;
        $data['contact'] = $request->contact;
        $data['comment'] = $request->comment;
        $data['setting'] = $request->setting;
        $data['role'] = $request->role;
        $data['other'] = $request->other;

        DB::table('admins')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Child Admin Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.all.user')->with($notification);
    }

}
