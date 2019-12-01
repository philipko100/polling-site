@extends('layouts.appNoTopNavbar')

@section('content')
<div class="page-content">
    <div class="login-area">
        <h2> Login </h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                            Email Address:<br>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <br>
                                Password:<br>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <br><br>
                                <a href="/login/facebook">
                                    <img width="200px" src="/storage/cover_images/signInButtons/18928641_251957295286418_4362086450741641216_n.png">
                                </a>
                                <br><br>

                                <a href="/login/google">
                                    <img  width="200px" src="/storage/cover_images/signInButtons/btn_google_signin_dark_normal_web.jpg">
                                </a>
                                <br><br>

                                <a href="/login/twitter">
                                    <img width="200px" src="/storage/cover_images/signInButtons/sign-in-with-twitter-link.jpg">
                                </a>
                                <br><br>
                                
                                <a href="/login/linkedin">
                                    <img width="200px" src="/storage/cover_images/signInButtons/Sign-in-Large---Default.jpg">
                                </a>
                                
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="/password/reset">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                    </form>
    </div>
</div>
@endsection
