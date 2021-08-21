@extends('layouts.app')

@section('content')
@include('layouts.menubar')

@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$vat = $setting->vat;
@endphp


<!-- Login and Register Form -->
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-7" style="border:1px solid gray; padding:25px; border-radius: 25px 0 0 25px ;">
                <div class="contact_form_container">
                    <div class="contact_form_title text-center">Cart Products</div>
                    <hr>
                    <div class="cart_container">
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach($cart as $row)
                                <li class="cart_item clearfix">
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_text">
                                                <img src="{{URL::to($row->options->image)}}" alt=""
                                                    style="width:50px; height:50px;">
                                            </div>
                                        </div>
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{$row->name}}</div>
                                        </div>
                                        @if($row->options->color == null)
                                        @else
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text">{{$row->options->color}}</div>
                                        </div>
                                        @endif
                                        @if($row->options->size == null)
                                        @else
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Size</div>
                                            <div class="cart_item_text">{{$row->options->size}}</div>
                                        </div>
                                        @endif

                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text">
                                                {{$row->qty}}
                                            </div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">${{$row->price}}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Total</div>
                                            <div class="cart_item_text">${{$row->price*$row->qty}}</div>
                                        </div>

                                    </div>
                                </li>
                                <br>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                        <!-- Order Total -->
                        <div class="col-lg-8 float-right">
                            <ul class="list-group">
                                @if(Session::has('coupon'))
                                <li class="list-group-item">Subtotal:
                                    <span id="pcode" style="float:right;">${{Session::get('coupon')['balance']}}</span>
                                </li>
                                <li class="list-group-item">
                                    Coupon: <span style="color:blue;">{{Session::get('coupon')['name']}}</span>
                                    <span id="psubcat"
                                        style="float:right;">${{Session::get('coupon')['discount']}}</span>

                                </li>
                                @else
                                <li class="list-group-item">Subtotal:
                                    <span id="pcode" style="float:right;">${{Cart::Subtotal()}}</span>
                                </li>
                                @endif
                                <li class="list-group-item">Shiping Charge: <span id="pbrand"
                                        style="float:right;">${{$charge}}</span></li>
                                <li class="list-group-item">VAT: <span id="pbrand" style="float:right;">${{$vat}}</span>
                                </li>
                                @if(Session::has('coupon'))
                                <li class="list-group-item">Total:
                                    <span id="pbrand"
                                        style="float:right;">${{Session::get('coupon')['balance']+$charge+$vat}}</span>
                                </li>
                                </li>
                                @else
                                <li class="list-group-item">Total:
                                    <span id="pbrand" style="float:right;">${{Cart::Subtotal()+$charge+$vat}}</span>
                                </li>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5" style="border:1px solid gray; padding:25px; border-radius: 0 25px 25px 0; ">
                <div class="contact_form_container">
                    <div class="contact_form_title text-center">Payment Order</div>
                    <hr>
                    <br>
                    <br>
                    <form id="payment_order" action="{{route('oncash.charge')}}" method="post">
                        @csrf
                        <input type="hidden" name="payment_type" value="{{$data['payment']}}">
                        <input type="hidden" name="shipping" value="{{$charge}}">
                        <input type="hidden" name="vat" value="{{$vat}}">
                        <input type="hidden" name="total" value="{{Cart::Subtotal() + $charge + $vat}}" id="total">
                        <input type="hidden" name="ship_name" value="{{$data['name']}}">
                        <input type="hidden" name="ship_phone" value="{{$data['phone']}}">
                        <input type="hidden" name="ship_email" value="{{$data['email']}}">
                        <input type="hidden" name="ship_address" value="{{$data['address']}}">
                        <input type="hidden" name="ship_city" value="{{$data['city']}}">
                        <div class="form-group">
                            <div class="text-center">Cash On Delevery</div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">Pay Now</button>
                        </div>
                    </form>
                    
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>


@endsection