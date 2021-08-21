@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_single_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_single_responsive.css')}}">
@section('content')
@include('layouts.menubar')

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll"
        data-image-src="{{asset('public/frontend/images/blog_single_background.jpg')}}" data-speed="0.8"></div>
</div>

<!-- Single Blog Post -->

<div class="single_post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                @if(Session()->get('lang') == 'english')
                <div class="single_post_title">{{$post->post_title_en}}</div>
                <div class="single_post_quote text-center">
                    <div class="quote_image"><img src="{{URL::to($post->post_image)}}" alt=""></div>
                    <div class="quote_text">{!!$post->details_en!!}
                    </div>
                </div>
                @else
                <div class="single_post_title">{{$post->post_title_vi}}</div>
                <div class="quote_image"><img src="{{URL::to($post->post_image)}}" alt=""></div>
                <div class="single_post_quote text-center">
                    
                    <div class="quote_text">{!!$post->details_vi!!}
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection