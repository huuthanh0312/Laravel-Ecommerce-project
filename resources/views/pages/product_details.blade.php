@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_responsive.css')}}">
@section('content')
@include('layouts.menubar')

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{URL::to($product->image_one)}}"><img src="{{URL::to($product->image_one)}}"
                            alt=""></li>
                    <li data-image="{{URL::to($product->image_two)}}"><img src="{{URL::to($product->image_two)}}"
                            alt=""></li>
                    <li data-image="{{URL::to($product->image_three)}}"><img src="{{URL::to($product->image_three)}}"
                            alt=""></li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected"><img src="{{URL::to($product->image_one)}}" alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <div class="product_category">{{$product->category_name}} > {{$product->subcategory_name}}</div>
                    <div class="product_name">{{$product->product_name}}</div>
                    <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="product_text">
                        <p>{!! str_limit($product->product_details, $limit = 1200) !!}</p>
                    </div>

                    <div class="order_info d-flex flex-row ">
                        <form action="{{url('cart/product/add/'.$product->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <!-- Product Color -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <select name="color" id="color" class="form-control">
                                            @foreach($product_color as $color)
                                            <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Product Size -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <select name="size" id="size" class="form-control">
                                            @foreach($product_size as $size)
                                            <option value="{{$size}}">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Product Quantity -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="color">Quantity</label>
                                        <input type="number" class="form-control" value="1" pattern="[0-9]" name="qty">
                                    </div>
                                </div>
                            </div>
                            <div class="product_price">
                                <div class="product_price discount">
                                    <h2>
                                        @if($product->discount_price == null)
                                        ${{$product->selling_price}}
                                        @else
                                        ${{$product->discount_price}}<span>${{$product->selling_price}}</span>
                                        @endif
                                    </h2>

                                </div>
                            </div>
                            <div class="button_container">
                                <button type="submit" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>
                            <br>
                            <hr>


                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox_rxrz"></div>


                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- Product Details -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Product Details</h3>
                    <div class="viewed_nav_container">
                        <!-- <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div> -->
                    </div>
                </div>

                <div class="viewed_slider_container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Product Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Video link</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Product Preview</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">{!!
                            $product->product_details !!}</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{$product->video_link}}" allowfullscreen></iframe>
                            </div>    
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="fb-comments" data-href="{{Request::url()}}" data-width="100%    "
                                data-numposts="5">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
$related = DB::table('products')->where('status', 1)->where('id','!=', $product->id)
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

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0"
    nonce="0eQizNQH"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-611d4fb7481ae0b2"></script>


@endsection