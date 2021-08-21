<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use Auth;
use Mail;


class PaymentController extends Controller
{
    /*
    */
    public function paymentProcess(Request $request){
        $cart = Cart::Content();

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
        //dd($data);

        if($request->payment == 'stripe'){
            return view('pages.payment.stripe' , compact('data', 'cart'));
        }elseif($request->payment == 'paypal'){
            return view('pages.payment.paypal' , compact('data', 'cart'));
        }elseif($request->payment == 'oncash'){
            return view('pages.payment.oncash' , compact('data', 'cart'));
        }

    }

    public function stripeCharge(Request $request){
        $email = Auth::user()->email;
        $total = $request->total;

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51JMDCXCmphvJOCxSngMo7oTtmHEDKxOYTHooyVY3OFwZqTkKjUwVMsyQyRzXwnHN4fIVFQsfixt6ccPZFlUrip5E00y5Fc06mu');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total*100,
        'currency' => 'usd',
        'description' => 'Thanh Store Ecommerce Details',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);
        //dd($charge);

        //Insert data order 
        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_type'] = $request->payment;
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['blnc_transection'] = $charge->balance_transection;
        $data['stripe_order_id'] = $charge->metadata_order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['status_code'] = mt_rand(100000, 999999);
        
        if(Session::has('coupon')){
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId('$data');

        $data['name'] = Auth::user()->name;
        //Send Mail Orders 
        Mail::to($email)->send(new invoiceMail($data));



        //Insert data shipping 
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        //Insert Data Order Details

        $content = Cart::Content();
        $details = array();
        foreach($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] =$row->price* $row->qty;

            DB::table('orders_details')->insert($details);
        }
        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification=array(
        'message'=>'Order Process Successfully Done',
        'alert-type'=>'success'
            );
        return Redirect()->to('/')->with($notification); 
    }

    public function paypalCharge(Request $request){
        $email = Auth::user()->email;
        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_type'] = $request->payment_type;
        $data['payment_id'] = $request->payment_id;
        $data['paying_amount'] = $request->total;
        $data['blnc_transection'] = $request->paypal_order_id;
        $data['stripe_order_id'] = $request->paypal_order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['status_code'] = mt_rand(100000, 999999);
        
        if(Session::has('coupon')){
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);
        
        $data['name'] = Auth::user()->name;
        //Send Mail Orders 
        Mail::to($email)->send(new invoiceMail($data));
        //Insert data shipping 
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        //Insert Data Order Details

        $content = Cart::Content();
        $details = array();
        foreach($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] =$row->price* $row->qty;

            DB::table('orders_details')->insert($details);
        }
        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification=array(
        'message'=>'Order Process Successfully Done',
        'alert-type'=>'success'
            );
        return Redirect()->to('/')->with($notification); 
    }
    public function oncashCharge(Request $request){
        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_type'] = $request->payment_type;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['status_code'] = mt_rand(100000, 999999);
        
        if(Session::has('coupon')){
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);
        

        //Insert data shipping 
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        //Insert Data Order Details

        $content = Cart::Content();
        $details = array();
        foreach($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] =$row->price* $row->qty;

            DB::table('orders_details')->insert($details);
        }
        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification=array(
        'message'=>'Order Process Successfully Done',
        'alert-type'=>'success'
            );
        return Redirect()->to('/')->with($notification); 
    }

}