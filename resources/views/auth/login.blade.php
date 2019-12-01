@extends('layouts.appNoTopNavbar')

@section('content')
<div class="container" style="padding-top: 3%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <br><br>
                                      <a href="/login/facebook" class="fb connect">Continue with Facebook</a>
                                <br><br>

                                <a href="/login/google">
                                <div class="google-btn">
                                        <div class="google-icon-wrapper" >
                                          <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                                        </div>
                                        <p class="btn-text"><b>Sign in with Google</b></p>
                                      </div>
                                    </a>
                                      <br>

                                <a href="/login/linkedin" title="LinkedIn" class="btn btn-linkedin btn-lg"><i class="fa fa-linkedin-square" style="padding:0px; font-size:24px; float:left;"></i><p style="float: right;">Sign in with LinkedIn</p></a>
                                <br><br>

                                <a href="/login/twitter" title="Twitter" class="btn btn-twitter btn-lg"><i class="fa fa-twitter fa-fw" style="float:left;"></i>Sign in with Twitter</a>
                                <br><br>
                                
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="/password/reset">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
