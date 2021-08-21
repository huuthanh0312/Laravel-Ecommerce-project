@php
$setting = DB::table('sitesetting')->first();
@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <title>ThanhStore</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/slick-1.8.0/slick.css')}}">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/main_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/responsive.css')}}">
</head>

<body>
    <div class="super_container">
        <!-- Header -->

        <header class="header">

            <!-- Top Bar -->

            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{asset('public/frontend/images/phone.png')}}"
                                        alt=""></div>+{{$setting->phone_one}}
                            </div>
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{asset('public/frontend/images/mail.png')}}"
                                        alt="">
                                </div>
                                support@thanhstore.com
                            </div>
                            <div class="top_bar_content ml-auto">
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        @php
                                        $language = Session()->get('lang');
                                        @endphp
                                        <li>
                                            @if(Session()->get('lang') == 'english')
                                            <a href="{{route('language.vietnam')}}">VietNam<i
                                                    class="fas fa-chevron-down"></i></a>
                                            @else
                                            <a href="{{route('language.english')}}">English<i
                                                    class="fas fa-chevron-down"></i></a>
                                            @endif
                                        </li>

                                    </ul>
                                </div>
                                @guest
                                @else
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="" data-toggle="modal" data-target="#exampleModal">My Order Tracking
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="top_bar_user">
                                    @endguest

                                    @guest
                                    <a href="{{route('login')}}">
                                        <div class="user_icon">
                                            <img src="{{asset('public/frontend/images/user.svg')}}">
                                        </div>
                                        Register|Sign in
                                    </a>
                                    @else
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <div class="user_icon"><img src="{{asset('public/frontend/images/user.svg')}}">
                                        </div>
                                        <li>
                                            <a href="#">Profile<i class="fas fa-chevron-down"></i></a>
                                            <ul>
                                                <li><a href="{{route('user.wishlist')}}">Wishlist</a></li>
                                                <li><a href="{{route('user.checkout')}}">Checkout</a></li>
                                                <li><a href="{{route('profile')}}">Others</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    @endguest

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="{{url('/')}}"><img
                                            src="{{asset('public/frontend/images/logo.png')}}" width='160px;'
                                            height='100px;' alt=""></a></div>
                            </div>
                        </div>

                        <!-- Search -->
                        @php
                        $category = DB::table('categories')->get();
                        @endphp
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="{{route('search.product')}}" method="post"
                                            class="header_search_form clearfix">
                                            @csrf
                                            <input type="search" required="required" class="header_search_input"
                                                placeholder="Search for products..." name="search">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        <li><a class="clc" href="#">All Categories</a></li>
                                                        @foreach($category as $row)
                                                        <li><a class="clc" href="#">{{$row->category_name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <button type="submit" class="header_search_button trans_300"
                                                value="Submit"><img src="{{asset('public/frontend/images/search.png')}}"
                                                    alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                @guest
                                @else
                                @php
                                $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->get();
                                @endphp
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    <div class="wishlist_icon"><img src="{{asset('public/frontend/images/heart.png')}}"
                                            alt=""></div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a href="{{route('user.wishlist')}}">Wishlist</a>
                                        </div>
                                        <div class="wishlist_count"><span id="count_wishlist">{{count($wishlist)}}</span></div>
                                    </div>
                                </div>
                                @endguest


                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="{{asset('public/frontend/images/cart.png')}}" alt="">
                                            <div class="cart_count"><span>{{Cart::count()}}</span></div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{route('show.cart')}}">Cart</a></div>
                                            <div class="cart_price">${{Cart::subtotal()}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->



            @yield('content')


            <!-- Newsletter -->

            <div class="newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div
                                class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                                <div class="newsletter_title_container">
                                    <div class="newsletter_icon"><img src="{{asset('public/frontend/images/send.png')}}"
                                            alt="">
                                    </div>
                                    <div class="newsletter_title">Sign up for Newsletter</div>
                                    <div class="newsletter_text">
                                        <p>...and receive %20 coupon for first shopping.</p>
                                    </div>
                                </div>
                                <div class="newsletter_content clearfix">
                                    <form action="{{route('store.newslater')}}" class="newsletter_form" method="post">
                                        @csrf
                                        <input type="email" name="email" class="newsletter_input" required="required"
                                            placeholder="Enter your email address">
                                        <button type="submit" class="newsletter_button">Subscribe</button>
                                    </form>
                                    <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->

            <footer class="footer">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <div class="logo"><a href="{{url('/')}}">{{$setting->company_name}}</a></div>
                                </div>
                                <div class="footer_title">Got Question? Call Us 24/7</div>
                                <div class="footer_phone">+{{$setting->phone_one}}</div>
                                <div class="footer_contact_text">
                                    <p>{{$setting->company_address}}</p>
                                </div>
                                <div class="footer_social">
                                    <ul>
                                        <li><a href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{$setting->youtube}}"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 offset-lg-2">
                        </div>

                    </div>
                </div>
            </footer>

            <!-- Copyright -->

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div
                                class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                                <div class="copyright_content">
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy; 2021
                                    <!-- <script> document.write(new Date().getFullYear());</script>  -->
                                    All rights reserved | Make By Huu Thanh Nguyen
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </div>
                                <div class="logos ml-sm-auto">
                                    <ul class="logos_list">
                                        <li><a href="#"><img src="{{asset('public/frontend/images/logos_1.png')}}"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('public/frontend/images/logos_2.png')}}"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('public/frontend/images/logos_3.png')}}"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('public/frontend/images/logos_4.png')}}"
                                                    alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your Status Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('order.tracking')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <input type="text" name="code" class="form-control" placeholder="Enter Order status code"
                            required>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Track Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
    <script src="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/slick-1.8.0/slick.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/easing/easing.js')}}"></script>
    <script src="{{asset('public/frontend/js/custom.js')}}"></script>

       <script type="text/javascript">
    function productView(id) {
        $.ajax({
            url: "{{url('view/product/cart/')}}/" + id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#product_id').val(data.product.id)
                $('#pname').text(data.product.product_name);
                $('#pcode').text(data.product.product_code);
                $('#pcat').text(data.product.category_name);
                $('#psubcat').text(data.product.subcategory_name);
                $('#pbrand').text(data.product.brand_name);
                $('#pimage').attr('src', "{{asset('')}}"+data.product.image_one);

                var d = $('select[name="color"]').empty();
                $.each(data.color, function(key, value) {
                    $('select[name="color"]').append('<option value="' + value + '">' + value +
                        '</option>');
                });

                var d = $('select[name="size"]').empty();
                $.each(data.size, function(key, value) {
                    $('select[name="size"]').append('<option value="' + value + '">' + value +
                        '</option>');
                });
            },
        });
    }
    </script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
    </script>
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
        <!-- Confirmation danger Delete -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    </script>
    <script>
    $(document).on('click', '#return', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
                title: "Are you Want to Return",
                text: "Once Return, This Will Return Your Money",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal('Cancel');
                }
            });
    });
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
                title: "Are you Want to Delete",
                text: "Once Delete, This Will delete wishlist",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal('Cancel');
                }
            });
    });
    </script>
</body>

</html>