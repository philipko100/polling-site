@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
    
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
    
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="political_position" class="col-md-4 col-form-label text-md-right">{{ __('What is your political orientation?') }}</label>
    
                                <div class="col-md-6">
                                    <select id="political_position" class="custom-select form-control{{ $errors->has('political_position') ? ' is-invalid' : '' }}" name="political_position" value="{{ old('political_position') }}" required autofocus>
                                            <option value = "" disabled selected>Choose political orientation</option> 
                                            <option value = "Radical Libertarian or Neoliberal">Radical Libertarian or Neoliberal</option>
                                            <option value = "Classical Liberal (different from modern definition of Liberal)">Classical Liberal (different from modern definition of "Liberal")</option>
                                            <option value = "Conservative Fascist (also known as alt-right)">Conservative Fascist (also known as "alt-right")</option>
                                            <option value = "Conservative">Conservative</option>
                                            <option value = "Moderately Conservative">Moderately Conservative</option>
                                            <option value = "Centrist">Centrist</option>
                                            <option value = "Moderately Liberal">Moderately Liberal</option>
                                            <option value = "Liberal">Liberal</option>
                                            <option value = "Socialist">Socialist</option>
                                            <option value = "Leftist Fascist (also known as Antifa)">Leftist Fascist (also known as "Antifa")</option>
                                            <option value = "Marxist Communist">Marxist Communist</option>
                                            <option value = "Don't know">------ Don't know -------</option>
                                        </select>
    
                                    @if ($errors->has('political_position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('political_position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
