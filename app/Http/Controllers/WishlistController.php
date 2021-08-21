<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class WishlistController extends Controller
{
    public function addWishlist($id){
        $user_id = Auth::id();
        $check = DB::table('wishlists')->where('product_id',$id)->first();

        $data = array();
        $data['user_id'] = $user_id;
        $data['product_id'] = $id;
        if(Auth::check()){
            if($check ){
                return Response::json(['error'=>'Aleady Has In Your Wishlist']);
            }else{
                DB::table('wishlists')->insert($data);
                $count = DB::table('wishlists')->count();
                return Response::json(['success'=>'Add to Wishlist','count'=>$count]);
            }
        }else{
            return Response::json(['error'=>'Login Your Acount First']);
        }
    }

    public function viewWishList(){
        $user_id = Auth::id();
        $product = DB::table('wishlists')
                        ->join('products', 'products.id', 'wishlists.product_id')
                        ->select('products.*', 'wishlists.user_id')
                        ->where('user_id', $user_id)->get();
        return view('pages.wishlist', compact('product'));
    }
    public function deleteWishList($id){
        $user_id = Auth::id();
        $product = DB::table('wishlists')->where('user_id', $user_id)->where('product_id', $id)->delete();
        $notification=array(
            'message'=>'Deleted Wishlist Successfully',
            'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification); 
    }
}
