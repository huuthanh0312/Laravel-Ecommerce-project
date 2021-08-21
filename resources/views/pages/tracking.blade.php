@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_responsive.css')}}">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
@section('content')
@include('layouts.menubar')
<style>
.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center;

}

.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 80px;
    text-align: center
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}

.steps .step .step-icon-wrap::before {
    left: 0
}

.steps .step .step-icon-wrap::after {
    right: 0
}

.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 38px;
    line-height: 81px;
    z-index: 5;
    padding-top: 20px;
}

.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.steps .step:first-child .step-icon-wrap::before {
    display: none
}

.steps .step:last-child .step-icon-wrap::after {
    display: none
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
    background-color: #0da9ef
}

.steps .step.completed .step-icon {
    border-color: #0da9ef;
    background-color: #0da9ef;
    color: #fff
}

@media (max-width: 576px) {

    .flex-sm-nowrap .step .step-icon-wrap::before,
    .flex-sm-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 768px) {

    .flex-md-nowrap .step .step-icon-wrap::before,
    .flex-md-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 991px) {

    .flex-lg-nowrap .step .step-icon-wrap::before,
    .flex-lg-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 1200px) {

    .flex-xl-nowrap .step .step-icon-wrap::before,
    .flex-xl-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

.bg-faded,
.bg-secondary {
    background-color: #f5f5f5 !important;
}
</style>
<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-7 offset--lg-1">
                <div class="contact_form_container">
                    <h2 class="text-center">Your Order Status</h2>
                    <br>
                    <div class="cart_container padding-bottom-3x mb-1">
                        <div class="card mb-3">
                            <div class="p-4 text-center text-white text-lg bg-dark rounded-top">
                                <span class="text-uppercase">Tracking Order No - </span>
                                <span class="text-medium">{{$track->status_code}}</span>
                            </div>
                            <br>
                            <br>
                            <div class="card-body">
                                <div
                                    class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">

                                    @if($track->status == 0)
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-cart"></i></div>
                                        </div>
                                        <h4 class="step-title text-warning" >Order Are Under Review</h4>
                                    </div>
                                    <div class="step ">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-config"></i></div>
                                        </div>
                                        <h4 class="step-title">Payment Accpect Urder Process</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-car"></i></div>
                                        </div>
                                        <h4 class="step-title">Packing Done Handover Process</h4>
                                    </div>

                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-home"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Complete</h4>
                                    </div>
                                    @elseif($track->status == 1)
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-cart"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Are Under Review</h4>
                                    </div>
                                    <div class="step completed ">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-config"></i></div>
                                        </div>
                                        <h4 class="step-title text-info">Payment Accpect Urder Process</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-car"></i></div>
                                        </div>
                                        <h4 class="step-title">Packing Done Handover Process</h4>
                                    </div>

                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-home"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Complete</h4>
                                    </div>
                                    @elseif($track->status == 2)
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-cart"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Are Under Review</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-config"></i></div>
                                        </div>
                                        <h4 class="step-title ">Payment Accpect Urder Process</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-car"></i></div>
                                        </div>
                                        <h4 class="step-title text-info">Packing Done Handover Process</h4>
                                    </div>

                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-home"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Complete</h4>
                                    </div>
                                    @elseif($track->status == 3)
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-cart"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Are Under Review</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-config"></i></div>
                                        </div>
                                        <h4 class="step-title">Payment Accpect Urder Process</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-car"></i></div>
                                        </div>
                                        <h4 class="step-title">Packing Done Handover Process</h4>
                                    </div>

                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="pe-7s-home"></i></div>
                                        </div>
                                        <h4 class="step-title text-success">Order Complete</h4>
                                    </div>
                                    @else
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon" style="background-color: red;">
                                                <i class="pe-7s-cart"></i>
                                            </div>
                                        </div>
                                        <h4 class="step-title">Order Cancel</h4>
                                    </div>
                                    @endif
                                    
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 offset--lg-1">
                <div class="contact_form_container">
                    <h2 class="text-center">Your Order Details</h2>
                    <br>
                    <ul class="list-group col-lg-12">
                        <li class="list-group-item"> <b>Payment Type:</b>  {{$track->payment_type}}</li>
                        <li class="list-group-item"><b>Payment ID:</b>  {{$track->payment_id}}</li>
                        <li class="list-group-item"><b>Subtotal:</b>  {{$track->subtotal}}$</li>
                        <li class="list-group-item"><b>Shipping:</b>  {{$track->shipping}}</li>
                        <li class="list-group-item"><b>Total:</b>  {{$track->payment_type}}$</li>
                        <li class="list-group-item"><b>Month:</b>  {{$track->month}}</li>
                        <li class="list-group-item"><b>Date:</b>  {{$track->date}}</li>
                        <li class="list-group-item"><b>Year:</b>  {{$track->year}}</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection