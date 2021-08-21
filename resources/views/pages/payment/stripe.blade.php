@extends('layouts.app')

@section('content')
@include('layouts.menubar')

@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$vat = $setting->vat;
@endphp
<style>
    .StripeElement{
        box-sizing: border-box;
        height:40px;
        width: 100%;
        padding:10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow:  0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease-in-out;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus{
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid{
        border-color:#fa755a;
    }
    .StripeElement--webkit-autofill{
        background-color:#fefde5 !important;
    }
</style>
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
                    <form action="{{route('stripe.charge')}}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <input type="hidden" name="payment_type" value="{{$data['payment']}}">
                        <input type="hidden" name="shipping" value="{{$charge}}">
                        <input type="hidden" name="vat" value="{{$vat}}">
                        <input type="hidden" name="total" value="{{Cart::Subtotal() + $charge + $vat}}">
                        <input type="hidden" name="ship_name" value="{{$data['name']}}">
                        <input type="hidden" name="ship_phone" value="{{$data['phone']}}">
                        <input type="hidden" name="ship_email" value="{{$data['email']}}">
                        <input type="hidden" name="ship_address" value="{{$data['address']}}">
                        <input type="hidden" name="ship_city" value="{{$data['city']}}">
                        <br>
                        <br>
                        <button class="btn btn-info btn-block">Pay ${{Cart::Subtotal()+$charge+$vat}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>

<script>
// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
var stripe = Stripe(
    'pk_test_51JMDCXCmphvJOCxSklnlklTSD7oxxc7YzTh1GAoZHapg1ejouHUBV7bCYLkMRBAnn8yJBX6Wk1uBX8pdJprcxymq00rCUV23c2');
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
var style = {
    base: {
        color: '#32325d',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder':{
            color: '#aab7c4'
        }       
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a',
    }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

//Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event){
    var displayError = document.getElementById('card-errors');
    if(event.error){
        displayError.textContent = event.error.message;

    }else{
        displayError.textContent ='';
    }
})
// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the customer that there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
</script>
@endsection