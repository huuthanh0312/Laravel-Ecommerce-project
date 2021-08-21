<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayOrder(){
        $today = date('d-m-y');
        $title = 'Today Order Report';
        $order = DB::table('orders')->where('date', $today)->where('status', 0)->get();
        return view('admin.report.report_order', compact('order', 'title'));
    }
    public function todayDelivery() {
        $today = date('d-m-y');
        $title = 'Today Delivery Report';
        $order = DB::table('orders')->where('date', $today)->where('status', 3)->get();
        return view('admin.report.report_order', compact('order', 'title'));
    }

    public function thisMonth() {
        $month = date('F');
        $title = 'This Month Order Report';
        $order = DB::table('orders')->where('month', $month)->where('status', 3)->get();
        return view('admin.report.report_order', compact('order', 'title'));
    }

    public function search() {
        return view('admin.report.search');
    }

    public function searchByDate(Request $request){
        $date = $request->date;
        $convert_date = date('d-m-Y', strtotime($date));
        $title = 'This Date '.$convert_date.' Report';
        $total = DB::table('orders')->where('date', $convert_date)->where('status', 3)->sum('total');
        $amount = "Total Amount This Month $".$total;

        $order = DB::table('orders')->where('date', $convert_date)->where('status', 3)->get();
        return view('admin.report.search_result', compact('order', 'title', 'amount'));
    }

    public function searchByMonth(Request $request){
        $month = $request->month;
        $title = 'This Month '.$month.' Report';
        $total = DB::table('orders')->where('month', $month)->where('status', 3)->sum('total');
        $amount = "Total Amount This Month $".$total;
        $order = DB::table('orders')->where('month', $month)->where('status', 3)->get();
        return view('admin.report.search_result', compact('order', 'title', 'amount'));
    }

    public function searchByYear(Request $request){
        $year = $request->year;
        $title = 'This Year '.$year.' Report';
        $total = DB::table('orders')->where('year', $year)->where('status', 3)->sum('total');
        $amount = "Total Amount This Year $".$total;
        $order = DB::table('orders')->where('year', $year)->where('status', 3)->get();
        return view('admin.report.search_result', compact('order', 'title', 'amount'));
    }

    
}
