@extends('layouts.app')

@section('content')
@include('layouts.menubar')
@include('layouts.slider')

@php
$featured = DB::table('products')
        ->where('status', 1)
        ->orderBy('id','DESC')
        ->limit(8)->get();
$trend = DB::table('products')
        ->where('status', 1)
        ->where('trend', 1)
        ->orderBy('id','DESC')
        ->limit(8)->get();
$best_rated = DB::table('products')
        ->where('status', 1)
        ->where('best_rated', 1)
        ->orderBy('id','DESC')
        ->limit(8)->get();
$hotnew = DB::table('products')
        ->join('brands', 'products.brand_id','brands.id')
        ->select('products.*', 'brands.brand_name')
        ->where('status', 1)
        ->where('hot_new',1)
        ->orderBy('id', 'DESC')
        ->limit(3)->get();
@endphp

<!-- Characteristics -->

<div class="characteristics">
    <div class="container">
        <div class="row">

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('public/frontend/images/char_1.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('public/frontend/images/char_2.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Fast Process</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('public/frontend/images/char_3.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Easy Payment Plan</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('public/frontend/images/char_4.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Coupon</div>
                        <div class="char_subtitle">from $100</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deals of the week -->

<div class="deals_featured">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                <!-- Deals -->

                <div class="deals">
                    <div class="deals_title">Deals of the Week</div>
                    <div class="deals_slider_container">

                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            @foreach($hotnew as $ht)
                            <!-- Deals Item -->
                            <div class="owl-item deals_item">
                                <div class="deals_image"><img src="{{URL::to($ht->image_one)}}"></div>
                                <div class="deals_content">
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_category"><a href="#">{{$ht->brand_name}}</a></div>
                                        @if($ht->discount_price != null)
                                        <div class="deals_item_price_a ml-auto">${{$ht->selling_price}}</div>
                                        @endif
                                    </div>
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_name">
                                            <a href="{{url('product/details/'.$ht->id.'/'.$ht->product_name)}}">{{$ht->product_name}}</a>
                                        </div>
                                        @if($ht->discount_price != null)
                                        <div class="deals_item_price ml-auto">${{$ht->discount_price}}</div>
                                        @else
                                        <div class="deals_item_price ml-auto">${{$ht->selling_price}}</div>
                                        @endif

                                    </div>
                                    <div class="available">
                                        <div class="available_line d-flex flex-row justify-content-start">
                                            <div class="available_title">Available:
                                                <span>{{$ht->product_quantity}}</span>
                                            </div>
                                            <div class="sold_title ml-auto">Already sold:
                                                <span>{{$ht->product_quantity}}</span>
                                            </div>
                                        </div>
                                        <div class="available_bar"><span style="width:17%"></span></div>
                                    </div>
                                    <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                        <div class="deals_timer_title_container">
                                            <div class="deals_timer_title">Hurry Up</div>
                                            <div class="deals_timer_subtitle">Offer ends in:</div>
                                        </div>
                                        <div class="deals_timer_content ml-auto">
                                            <div class="deals_timer_box clearfix" data-target-time="">
                                                <div class="deals_timer_unit">
                                                    <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                    <span>hours</span>
                                                </div>
                                                <div class="deals_timer_unit">
                                                    <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                    <span>mins</span>
                                                </div>
                                                <div class="deals_timer_unit">
                                                    <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                    <span>secs</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i>
                        </div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i>
                        </div>
                    </div>
                </div>

                <!-- Featured -->
                <div class="featured">
                    <div class="tabbed_container">
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="active">Featured</li>
                                <li>On Sale</li>
                                <li>Best Rated</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <!-- Product Panel -->
                        <div class="product_panel panel active">
                            <div class="featured_slider slider">
                                @foreach($featured as $row)
                                <!-- Slider Item -->
                                <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <div
                                        class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div
                                            class="product_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{URL::to($row->image_one)}}" alt="" height="120px;"
                                                width="140px;">
                                        </div>
                                        <div class="product_content">
                                            <div class="product_price discount">
                                                @if($row->discount_price == null)
                                                ${{$row->selling_price}}
                                                @else
                                                ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                                @endif
                                            </div>
                                            <div class="product_name">
                                                <div>
                                                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                                </div>
                                            </div>
                                            <div class="product_extras">
                                                <button class="product_cart_button addcart" id="{{$row->id}}"
                                                    data-toggle="modal" data-target="#cardmodal" onclick="productView(this.id)">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                        <button class="addwishlist invisible" data-id="{{$row->id}}">
                                            <div class="product_fav">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        </button>
                                        <ul class="product_marks">
                                            @if($row->discount_price == null)
                                            <li class="product_mark product_discount" style="background: blue;">new</li>
                                            @else
                                            <li class="product_mark product_discount">
                                                @php
                                                $amount = $row->selling_price - $row->discount_price;
                                                $discount = $amount/$row->selling_price*100;
                                                @endphp
                                                {{intval($discount) }}%</li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>

                        <!-- Product Panel -->

                        <div class="product_panel panel">
                            <div class="featured_slider slider">
                                @foreach($trend as $row)
                                <!-- Slider Item -->
                                <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <div
                                        class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div
                                            class="product_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{URL::to($row->image_one)}}" alt="" height="120px;"
                                                width="140px;">
                                        </div>
                                        <div class="product_content">
                                            <div class="product_price discount">
                                                @if($row->discount_price == null)
                                                ${{$row->selling_price}}
                                                @else
                                                ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                                @endif
                                            </div>
                                            <div class="product_name">
                                                <div>
                                                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                                </div>
                                            </div>
                                            <div class="product_extras">
                                                <div class="product_color">
                                                    <input type="radio" checked name="product_color"
                                                        style="background:#b19c83">
                                                    <input type="radio" name="product_color" style="background:#000000">
                                                    <input type="radio" name="product_color" style="background:#999999">
                                                </div>
                                                <button class="product_cart_button addcart" data-id="{{$row->id}}">Add
                                                    to Cart</button>
                                            </div>
                                        </div>
                                        <button class="addwishlist invisible" data-id="{{$row->id}}">
                                            <div class="product_fav">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        </button>
                                        <ul class="product_marks">
                                            @if($row->discount_price == null)
                                            <li class="product_mark product_discount" style="background: blue;">new</li>
                                            @else
                                            <li class="product_mark product_discount">
                                                @php
                                                $amount = $row->selling_price - $row->discount_price;
                                                $discount = $amount/$row->selling_price*100;
                                                @endphp
                                                {{intval($discount) }}%</li>
                                            @endif


                                        </ul>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>

                        <!-- Product Panel -->

                        <div class="product_panel panel">
                            <div class="featured_slider slider">

                                @foreach($best_rated as $row)
                                <!-- Slider Item -->
                                <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <div
                                        class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div
                                            class="product_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{URL::to($row->image_one)}}" alt="" height="120px;"
                                                width="140px;">
                                        </div>
                                        <div class="product_content">
                                            <div class="product_price discount">
                                                @if($row->discount_price == null)
                                                ${{$row->selling_price}}
                                                @else
                                                ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                                @endif
                                            </div>
                                            <div class="product_name">
                                                <div><a
                                                        href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                                </div>
                                            </div>
                                            <div class="product_extras">
                                                <div class="product_color">
                                                    <input type="radio" checked name="product_color"
                                                        style="background:#b19c83">
                                                    <input type="radio" name="product_color" style="background:#000000">
                                                    <input type="radio" name="product_color" style="background:#999999">
                                                </div>
                                                <button class="product_cart_button addcart" id="{{$row->id}}"
                                                    data-toggle="modal" data-target="#cardmodal" onclick="productView(this.id)">Add
                                                    to Cart</button>
                                            </div>
                                        </div>
                                        <button class="addwishlist invisible" data-id="{{$row->id}}">
                                            <div class="product_fav">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        </button>
                                        <ul class="product_marks">
                                            @if($row->discount_price == null)
                                            <li class="product_mark product_discount" style="background: blue;">new</li>
                                            @else
                                            <li class="product_mark product_discount">
                                                @php
                                                $amount = $row->selling_price - $row->discount_price;
                                                $discount = $amount/$row->selling_price*100;
                                                @endphp
                                                {{intval($discount) }}%</li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->
@php
$category = DB::table('categories')->get();
@endphp
<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content">
                    <div class="popular_categories_title">Popular Categories</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i
                                class="fas fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i
                                class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                    
                </div>
            </div>

            <!-- Popular Categories Slider -->

            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">
                        @foreach($category as $row)
                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img
                                        src="{{asset('public/frontend/images/popular_1.png')}}" alt="">
                                </div>
                                <div class="popular_category_text">
                                    <a href="{{url('category/product/'.$row->id)}}">{{$row->category_name}}</a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->
@php
$mid_slider = DB::table('products')
->join('brands','brands.id','products.brand_id')
->join('categories','categories.id', 'products.category_id')
->select('products.*','brands.brand_name','categories.category_name')
->where('status', 1)
->where('mid_slider',1)
->orderBy('id','DESC')
->limit(3)->get();

@endphp
<div class="banner_2">
    <div class="banner_2_background"
        style="background-image:url({{asset('public/frontend/images/banner_2_background.jpg')}})"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">
            @foreach($mid_slider as $row)
            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">
                                        <h4>{{$row->category_name}}</h4>
                                    </div>
                                    <div class="banner_2_title">{{$row->product_name}}</div>
                                    <div class="banner_2_text">
                                        <h4> {{$row->brand_name}}</h4>
                                    </div>
                                    <h2>${{$row->selling_price}}</h2>

                                    <div class="rating_r rating_r_4 banner_2_rating">
                                        <i></i><i></i><i></i><i></i><i></i>
                                    </div>
                                    <div class="button banner_2_button"> 
                                        <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">Explore</a></div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{URL::to($row->image_one)}}"
                                            style="width: 300px;; height: 250px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>


<!-- Category  Product -->
@php
$count_cat = DB::table('categories')->count();

@endphp

@for( $i = 0; $i < $count_cat; $i++)

@php
$count_cat = DB::table('categories')->count();

$cats = DB::table('categories')->skip($i)->first();
$cat_id = $cats->id;

$product = DB::table('products')->where('category_id',$cat_id)
->where('status',1)
->orderBy('id', 'desc')->limit(10)->get();

@endphp
<div class="new_arrivals" style="background: #<?php if(($i % 2) == 1) echo"eff6fa"; ?>;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">{{$cats->category_name}}</div>
                        <ul class="clearfix">
                            <li class="active"></li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="z-index:1;">

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">
                                    @foreach($product as $row)
                                    <!-- Slider Item -->
                                    <div class="arrivals_slider_item">
                                        <div class="border_active"></div>
                                        <div
                                            class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                            <div
                                                class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{URL::to($row->image_one)}}" alt="" height="120px;"
                                                    width="140px;">

                                            </div>
                                            <div class="product_content">
                                                <div class="product_price discount">
                                                    @if($row->discount_price == null)
                                                    ${{$row->selling_price}}
                                                    @else
                                                    ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                                    @endif
                                                </div>
                                                <div class="product_name">
                                                    <div><a
                                                            href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                                    </div>
                                                </div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                        <input type="radio" checked name="product_color"
                                                            style="background:#b19c83">
                                                        <input type="radio" name="product_color"
                                                            style="background:#000000">
                                                        <input type="radio" name="product_color"
                                                            style="background:#999999">
                                                    </div>
                                                    <button class="product_cart_button addcart" id="{{$row->id}}"
                                                    data-toggle="modal" data-target="#cardmodal" onclick="productView(this.id)"">Add to Cart</button>
                                                </div>
                                            </div>
                                            <button class="addwishlist invisible" data-id="{{$row->id}}">
                                                <div class="product_fav">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            </button>
                                            <ul class="product_marks">
                                                @if($row->discount_price == null)
                                                <li class="product_mark product_new">new</li>
                                                @else
                                                <li class="product_mark product_new" style="background: red;">
                                                    @php
                                                    $amount = $row->selling_price - $row->discount_price;
                                                    $discount = $amount/$row->selling_price*100;
                                                    @endphp
                                                    {{intval($discount) }}%</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="arrivals_slider_dots_cover"></div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endfor


<!-- Buy One Get One -->
@php
$buyget = DB::table('products')
->join('brands','brands.id','products.brand_id')
->select('products.*','brands.brand_name')
->where('status', 1)
->where('buyone_getone',1)
->orderBy('id','DESC')
->limit(8)->get();

@endphp
<div class="trends">
    <div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
    <div class="trends_overlay"></div>
    <div class="container">
        <div class="row">

            <!-- Trends Content -->
            <div class="col-lg-3">
                <div class="trends_container">
                    <h2 class="trends_title">Buy One Get One</h2>
                    <div class="trends_text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p>
                    </div>
                    <div class="trends_slider_nav">
                        <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Trends Slider -->
            <div class="col-lg-9">
                <div class="trends_slider_container">

                    <!-- Trends Slider -->

                    <div class="owl-carousel owl-theme trends_slider">
                        @foreach($buyget as $row)
                        <!-- Trends Slider Item -->
                        <div class="owl-item">
                            <div class="trends_item is_new">
                                <div class="trends_image d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{URL::to($row->image_one)}}" alt="">
                                </div>
                                <div class="trends_content">
                                    <div class="trends_category"><a href="#">{{$row->brand_name}}</a></div>
                                    <div class="trends_info clearfix">
                                        <div class="trends_name"><a
                                                href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                        </div>
                                        <div class="product_price discount">
                                            @if($row->discount_price == null)
                                            ${{$row->selling_price}}
                                            @else
                                            ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <button class="btn btn-danger btn-sm addcart" id="{{$row->id}}"
                                            data-toggle="modal" data-target="#cardmodal" onclick="productView(this.id)">
                                            Add to Cart
                                        </button>
                                    </div>

                                </div>
                                <ul class="trends_marks">
                                    <li class="trends_mark trends_new">BuyGet</li>
                                </ul>
                                <button class="addwishlist invisible" data-id="{{$row->id}}">
                                    <div class="trends_fav">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Brands -->
@php
$brand = DB::table('brands')->get();
@endphp

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">

                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">
                        @foreach($brand as $row)
                        <div class="owl-item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <img src="{{URL::to($row->brand_logo)}}" style="width:110px; height:40px;">
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="cardmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="" alt="" id='pimage' style='width:150px; height:220px;'>
                                <br>
                                <br>
                                <div class="card-title" id="pname"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Code: <span id="pcode"></span></li>
                                <br>
                                <li class="list-group-item">Category: <span id="pcat"></span></li>
                                <br>
                                <li class="list-group-item">Subcategory: <span id="psubcat"></span></li>
                                <br>
                                <li class="list-group-item">Brand: <span id="pbrand"></span></li>
                                <br>
                                <li class="list-group-item">Stock:  <span class="badge" style="background:green;">Available</span>
                                </li>
                            </ul>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                        <form action="{{route('insert.into.cart')}}" method="post" >
                                @csrf
                                <div class="card-body">
                                        <input type="hidden" name="product_id" id="product_id">
                                        <div class="form-group row">
                                            <label for="color" class="col-lg-5 mt-1">Color: </label>
                                            <select name="color" id="color" class="form-control col-lg-5">
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="size" class="col-lg-5 mt-1">Size: </label>
                                            <select name="size" id="size" class="form-control col-lg-5">

                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="qty" class=" col-lg-5 mt-1">Quantity: </label>
                                            <input type="number" class="form-control col-lg-5 ml-2" name="qty" value="1" id="qty" >
                                        </div>
                                        <br>
                                        <div class="form-group"> 
                                        <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                                        </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('.addwishlist').on('click', function() {
        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: "{{url('add/wishlist/')}}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal
                                .resumeTimer)
                        }
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        })
                        $('#count_wishlist').text(data.count)
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        })
                    }

                },
            });
        } else {
            alert('Danger');
        }
    });
    // $('.addcart').on('click', function() {
    //     var id = $(this).data('id');
    //     if (id) {
    //         $.ajax({
    //             url: "{{url('add/cart/')}}/" + id,
    //             type: "GET",
    //             dataType: "json",
    //             success: function(data) {
    //                 const Toast = Swal.mixin({
    //                     toast: true,
    //                     position: 'top-end',
    //                     showConfirmButton: false,
    //                     timer: 3000,
    //                     timerProgressBar: true,
    //                     didOpen: (toast) => {
    //                         toast.addEventListener('mouseenter', Swal.stopTimer)
    //                         toast.addEventListener('mouseleave', Swal
    //                             .resumeTimer)
    //                     }
    //                 })
    //                 if ($.isEmptyObject(data.error)) {
    //                     Toast.fire({
    //                         icon: 'success',
    //                         title: data.success
    //                     })
    //                 } else {
    //                     Toast.fire({
    //                         icon: 'error',
    //                         title: data.error
    //                     })
    //                 }

    //             },
    //         });
    //     } else {
    //         alert('Danger');
    //     }
    // });
});


</script>    


@endsection