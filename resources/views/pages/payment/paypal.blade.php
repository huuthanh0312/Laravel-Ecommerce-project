@extends('layouts.app')

@section('content')
@include('layouts.menubar')

@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$vat = $setting->vat;
@endphp

<!-- <script
    src="https://www.paypal.com/sdk/js?client-id=AZGiZByRggReHx-uueBApd29jMmnr8kE5cqQ6u_V3YsmDqq0CElj5Mj92-wEbFhjK9E2wSiGLjfXc1s7">
</script> -->

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
                    <form id="payment_order" action="{{route('paypal.charge')}}" method="post">
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
                    </form>
                    <!-- <div id="paypal-button-container"></div> -->
                    <div id="paypal-button" class ="text-center">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
var amount = document.getElementById("total").value;

paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
        sandbox: 'AZGiZByRggReHx-uueBApd29jMmnr8kE5cqQ6u_V3YsmDqq0CElj5Mj92-wEbFhjK9E2wSiGLjfXc1s7',
        production: 'AZGiZByRggReHx-uueBApd29jMmnr8kE5cqQ6u_V3YsmDqq0CElj5Mj92-wEbFhjK9E2wSiGLjfXc1s7'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
        size: 'small',
        color: 'gold',
        shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '0.01',
                    currency: 'USD'
                }
            }]
        });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            //Show a confirmation message to the 
            var input = document.createElement("input");

            input.setAttribute("type", "hidden");

            input.setAttribute("name", "paypal_order_id");

            input.setAttribute("value", data.orderID);
            var input2 = document.createElement("input");

            input2.setAttribute("type", "hidden");

            input2.setAttribute("name", "payment_id");

            input2.setAttribute("value", data.paymentID);

            //append to form element that you want .
            document.getElementById("payment_order").appendChild(input);
            document.getElementById("payment_order").appendChild(input2);
            document.getElementById("payment_order").submit();

        });
    }
}, '#paypal-button');
</script>


@endsection