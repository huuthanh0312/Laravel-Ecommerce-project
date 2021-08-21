@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_responsive.css')}}">
@section('content')
@include('layouts.menubar')
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll"
        data-image-src="{{asset('public/frontend/images/shop_background.jpg')}}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Technological Blog</h2>
    </div>
</div>

<!-- Blog -->

<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog_posts d-flex flex-row align-items-start justify-content-between">
					@foreach($post as $row)
                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{asset(URL::to($row->post_image))}})"></div>
						@if(Session()->get('lang') == 'english')
						<div class="blog_text">
						{{$row->post_title_en}}
						</div>
                        <div class="blog_button"><a href="{{url('blog/single/'.$row->id)}}">Continue Reading</a></div>
						@else
						<div class="blog_text">
						{{$row->post_title_vi}}
						</div>
                        <div class="blog_button"><a href="{{url('blog/single/'.$row->id)}}">Tiếp Tục Đọc</a></div>
						@endif
                        
                    </div>
					@endforeach

                </div>
            </div>

        </div>
    </div>
</div>

@endsection