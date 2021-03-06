@extends('layouts.app')

@section('content')
<!-- Login and Register Form -->
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Your Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}"
                            aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="oldpass"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                                <div class="col-md-6">
                                    <input id="oldpass" type="password"
                                        class="form-control{{ $errors->has('oldpass') ? ' is-invalid' : '' }}"
                                        name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autofocus>

                                    @if ($errors->has('oldpass'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpass') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4 ">
                <div class="card">
                    <img src="{{ asset('public/frontend/images/send.png')}}" alt="" class="card-img-top"
                        style="width:90px; height:90px; margin-left:34%;">

                    <div class="card-body text-center">
                        <h5 class="card-title">{{Auth::user()->name}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{route('password.change')}}">Change Password</a> </li>
                        <li class="list-group-item">Line One</li>
                        <li class="list-group-item">Line One</li>
                        <li class="list-group-item">Line One</li>
                    </ul>
                    <div class="card-footer ">
                        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>
@endsection