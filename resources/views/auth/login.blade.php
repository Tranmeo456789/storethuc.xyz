@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card form-lgrg">
                <div class="card-header text-center title-form-login"><a href="{{url('/')}}"><div class="img-title-login"><img src="{{asset('images/logokieu.png')}}" /></div></a></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <div class="wp-input-icon">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                    <span class="icon-eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </div>
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check" style="font-size: 13px">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{old('remember')?'checked':''}}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <div><button style="width: 100%; margin-bottom: 5px;" type="submit" class="btn btn-primary">{{ __('Login') }}</button></div>
                                <!-- <div ><a href="{{url('/getInfo-facebook/facebook')}}">Đăng nhập facebook</a></div> -->
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="font-size: 14px; padding:0px;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                                <!-- <div class="float-right"><a style="font-size: 14px;" class="" href="">Đăng ký</a></div> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection