@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_responsive.css')}}">
@section('content')
@include('layouts.menubar')

@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$vat = $setting->vat;
@endphp
<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Checkout</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach($cart as $row)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image text-center">
                                    <br>
                                    <img src="{{URL::to($row->options->image)}}" alt="" style="width:80px; height:80px;">
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
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
                                            <form action="{{route('update.cartitem')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="productid" value="{{ $row->rowId}}">
                                                <input type="number" name="qty" value="{{$row->qty}}" style="width:50px;">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check-square"></i>
                                                </button>
                                            </form>
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
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Action</div>
                                        <div class="cart_item_text">
                                            <a href="{{url('remove/cart/'.$row->rowId)}}" class="btn btn-sm btn-danger">x</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>	
                </div>               
            </div>

        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-6">
                @if(Session::has('coupon'))
                @else
                <h4 class="ml-3">Apply Cupon</h4>
                <br>
                <form action="{{route('apply.coupon')}}" method="post">
                    @csrf
                    <div class="form-group col-lg-6">
                        <input type="text" name="coupon" class="form-control" placeholder="Enter Your Coupon">
                    </div>
                    <button class="btn btn-danger ml-3">Submit</button>
                </form>
                @endif
                
            </div>
            <div class="col-lg-6 float-right">  
                <ul class="list-group">
                    @if(Session::has('coupon'))
                        <li class="list-group-item">Subtotal: 
                            <span id="pcode" style="float:right;">${{Session::get('coupon')['balance']}}</span>
                        </li>
                        <li class="list-group-item">
                            Coupon: <span style="color:blue;">{{Session::get('coupon')['name']}}</span> 
                            <a href="{{route('remove.coupon')}}" class="btn btn-sm btn-danger">x</a>
                            <span id="psubcat" style="float:right;">${{Session::get('coupon')['discount']}}</span>

                        </li>
                    @else
                        <li class="list-group-item">Subtotal: 
                            <span id="pcode" style="float:right;">${{Cart::Subtotal()}}</span>
                        </li>
                    @endif
                    <li class="list-group-item">Shiping Charge: <span id="pbrand" style="float:right;">${{$charge}}</span></li>
                    <li class="list-group-item">VAT: <span id="pbrand" style="float:right;">${{$vat}}</span></li>
                    @if(Session::has('coupon'))
                    <li class="list-group-item">Total: 
                        <span id="pbrand" style="float:right;">${{Session::get('coupon')['balance']+$charge+$vat}}</span></li>
                    </li>
                    @else
                    <li class="list-group-item">Total: 
                        <span id="pbrand" style="float:right;">${{Cart::Subtotal()+$charge+$vat}}</span></li>
                    </li>
                    @endif
                    
                </ul>
                <div class="cart_buttons">
                    <a href="{{route('show.cart')}}" class="btn btn-outline-secondary btn-lg">All Cancel</a>
                    <a href="{{route('payment.page')}}" class="button cart_button_checkout">Final Step</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection