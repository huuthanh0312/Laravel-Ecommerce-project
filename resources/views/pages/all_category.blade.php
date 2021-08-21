@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/shop_responsive.css')}}">
@section('content')
@include('layouts.menubar')
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset('public/frontend/images/shop_background.jpg')}}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{$catname->category_name}}</h2>
    </div>
</div>

<!-- Shop -->
<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach($categories as $cat)
                            <li><a href="{{url('category/product/'.$cat->id)}}">{{$cat->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly
                                    style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle color_subtitle">Color</div>
                        <ul class="colors_list">
                            <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                            <li class="color"><a href="#" style="background: #000000;"></a></li>
                            <li class="color"><a href="#" style="background: #999999;"></a></li>
                            <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                            <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                            <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            @foreach($brands as $brand)
                            <li class="brand"><a href="#">{{$brand->brand_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>
                                <?php echo count($products); ?>
                            </span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button"
                                            data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name
                                        </li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'>
                                            price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>
                        @foreach($products as $row)
                        <!-- Product Item -->
                        <div class="product_item is_new">
                            <div class="product_border"></div>
                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                <img src="{{URL::to($row->image_one)}}" alt="" style="width: 100px; height: 100px;">
                            </div>
                            <div class="product_content">
                                <div class="product_price">
                                    @if($row->discount_price == null)
                                    ${{$row->selling_price}}
                                    @else
                                    ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                    @endif
                                </div>
                                <div class="product_name">
                                    <div>
                                        <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" tabindex="0">{{$row->product_name}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product_fav"><i class="fas fa-heart"></i></div>
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
                        @endforeach


                    </div>

                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i
                                class="fas fa-chevron-left"></i></div>
                        <ul class="page_nav d-flex flex-row">
                            {{$products->links()}}
                        </ul>
                        <div class="page_next d-flex flex-column align-items-center justify-content-center"><i
                                class="fas fa-chevron-right"></i></div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@php
$related = DB::table('products')->where('status', 1)->where('category_id','!=', $catname->id)
                                    ->orderBy('id', 'desc')->limit(12)->get();

@endphp
<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Related Products</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        @foreach($related as $row)
                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div
                                class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{URL::to($row->image_one)}}" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">
                                        @if($row->discount_price == null)
                                        ${{$row->selling_price}}
                                        @else
                                        ${{$row->discount_price}}<span>${{$row->selling_price}}</span>
                                        @endif    
                                    </div>
                                    <div class="viewed_name">
                                        <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                    </div>
                                </div>
                                <ul class="item_marks">
                                    @if($row->discount_price == null)
                                    <li class="item_mark item_discountt" style="background: blue;">new</li>
                                    @else
                                    <li class="item_mark item_discount">
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

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/frontend/js/shop_custom.js')}}"></script>
@endsection