@php
$category = DB::table('categories')->get();
$setting = DB::table('sitesetting')->first();
@endphp


<nav class="main_nav">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="main_nav_content d-flex flex-row">

                    <!-- Categories Menu -->

                    <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger"><span></span><span></span><span></span></div>
                            <div class="cat_menu_text">categories</div>
                        </div>

                        <ul class="cat_menu">
                            @foreach($category as $cat)
                            <li class="hassubs">
                                @php
                                $subcategory = DB::table('subcategories')->where('category_id',$cat->id)->get();
                                $key = count($subcategory);
                                @endphp
                                <a href="{{url('category/product/'.$cat->id)}}">{{$cat->category_name}}<i
                                        class="{{$key == 0 ? '' : 'fas fa-chevron-right'}}"></i></a>
                                <ul>

                                    @foreach($subcategory as $sub_cat)
                                    <li><a href="{{url('products/'.$sub_cat->id)}}">{{$sub_cat->subcategory_name}}</a>
                                    </li>
                                    @endforeach
                                </ul>

                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Main Nav Menu -->

                    <div class="main_nav_menu ml-auto">
                        <ul class="standard_dropdown main_nav_dropdown">
                            <li><a href="{{url('/')}}">Home<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="{{route('blog.post')}}">Blog<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="{{route('contact.page')}}">Contact<i class="fas fa-chevron-down"></i></a></li>
                        </ul>
                    </div>

                    <!-- Menu Trigger -->

                    <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                <div class="menu_trigger_text">menu</div>
                                <div class="cat_burger menu_burger_inner">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Menu -->

<div class="page_menu">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="page_menu_content">

                    <div class="page_menu_search">
                        <form action="{{route('search.product')}}" method="post">
                            @csrf
                            <input type="search" name="search" required="required" class="page_menu_search_input"
                                placeholder="Search for products...">
                        </form>
                    </div>
                    
                    <ul class="page_menu_nav">
                        <li class="page_menu_item has-children">
                            @php
                            $language = Session()->get('lang');
                            @endphp
                        
                            @if(Session()->get('lang') == 'english')
                            <a href="{{route('language.vietnam')}}">VietNam</a>
                            @else
                            <a href="{{route('language.english')}}">English</a>
                            @endif
                       
                        </li>

                        <li class="page_menu_item">
                            <a href="{{url('/')}}">Home<i class="fa fa-angle-down"></i></a>
                        </li>
                        <li class="page_menu_item"><a href="{{route('blog.post')}}">blog<i
                                    class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item"><a href="{{route('contact.page')}}">contact<i
                                    class="fa fa-angle-down"></i></a>
                        </li>
                    </ul>

                    <div class="menu_contact">
                        <div class="menu_contact_item">
                            <div class="menu_contact_icon"><img
                                    src="{{asset('public/frontend/images/phone_white.png')}}" alt=""></div>
                            +{{$setting->phone_one}}
                        </div>
                        <div class="menu_contact_item">
                            <div class="menu_contact_icon"><img src="{{asset('public/frontend/images/mail_white.png')}}"
                                    alt=""></div><a href="mailto:fastsales@gmail.com">support@thanhstore.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</header>