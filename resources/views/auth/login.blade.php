@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">
@section('content')
<!-- Login and Register Form -->
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1" style="border:1px solid gray; padding:25px; border-radius: 25px;">
                <div class="contact_form_container">
                    <div class="contact_form_title">Sign In</div>

                    <form action="{{route('login')}}" class="d-block" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email or Phone</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Email Address">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <div class="float-left ">
                                <label class="form-check-label" for="remember">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    Remember me </label>
                            </div>
                            <div class="float-right">
                                <a href="{{route('password.request')}}" class="">I forgot my password</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Sign In</button>
                        </div>
                    </form>
                    <hr>
                    <br>
                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary btn-block">
                        <i class="fab fa-facebook-square"></i> Login with Facebook
                    </a>
                    <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block">
                        <i class="fab fa-google"></i> Login with Google
                    </a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1" style="border:1px solid gray; padding:25px; border-radius: 25px;">
                <div class="contact_form_container">
                    <div class="contact_form_title">Sign Up</div>

                    <form action="{{route('register')}}" method="post" id="contact_form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                            id="name" aria-describedby="emailHelp" value="{{ old('name') }}" required
                                placeholder="Enter Full Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="emailHelp"
                                placeholder="Enter Phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email_up">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email_up"
                                value="{{ old('email') }}" required aria-describedby="emailHelp" placeholder="Enter your email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_up">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password_up" 
                                placeholder="Enter your Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Re-Type Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Sign Up</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>
@endsection