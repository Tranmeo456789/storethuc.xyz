@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="form-lgrg">
                <div class="text-center title-form-login"><div class="img-title-login"><a href="{{url('/')}}"><img src="{{asset('images/logokieu.png')}}" /></a></div></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="position-relative">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    <label for="" class="label">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <div class="wp-input-icon">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >
                                    <label for="" class="label">Mật khẩu</label>
                                    <span class="icon-eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </div>                             
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{old('remember')?'checked':''}}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                            </div>
                        </div>
                        <div class="container-login100-form-btn">
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button type="submit" class="btn login100-form-btn">{{ __('Login') }}</button>
                                    </div>
                                </div>
                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-12">
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