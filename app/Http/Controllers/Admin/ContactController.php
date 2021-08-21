<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allMessage(){
        $message = DB::table('contact')->get();
        return view('admin.contact.all_message', compact('message'));
    }

    public function viewMessage($id){
        $message = DB::table('contact')->where('id',$id)->first();
        return response::json(array('view_message' => $message));
    }
}
