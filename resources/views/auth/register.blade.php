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
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('What is your gender?') }}</label>
                                <div class="col-md-6">
                                    <select id="gender" class="custom-select form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
                                            <option value = "" disabled selected>Choose gender</option> 
                                            <option value = "male">Male</option>
                                            <option value = "female">Female</option>
                                            <option value = "other">Other</option>
                                        </select>
    
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>
    
                                <div class="col-md-6">
                                    <input id="birth_date" type="date" value="2000-1-1" min="1900-1-1" max="2019-7-16" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" value="{{ old('birth_date') }}" required autofocus>
    
                                    @if ($errors->has('birth_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="current_country" class="col-md-4 col-form-label text-md-right">{{ __('Where do you live?') }}</label>
        
                                    <div class="col-md-6">
                                        Country: <input id="current_country" type="text" placeholder="e.g. United States of America" class="form-control{{ $errors->has('current_country') ? ' is-invalid' : '' }}" name="current_country" value="{{ old('current_country') }}" required autofocus>
        
                                        @if ($errors->has('current_country'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('current_country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                            Province/State/Region: <input id="current_province" type="text" placeholder="e.g. California or British Columbia" class="form-control{{ $errors->has('current_province') ? ' is-invalid' : '' }}" name="current_province" value="{{ old('current_province') }}" required autofocus>
            
                                            @if ($errors->has('current_province'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('current_province') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                                City: <input id="current_city" type="text" placeholder="e.g. San Francisco or Vancouver" class="form-control{{ $errors->has('current_city') ? ' is-invalid' : '' }}" name="current_city" value="{{ old('current_city') }}" required autofocus>
                
                                                @if ($errors->has('current_city'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('current_city') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                </div>
                                


                            <!---take political_position out-->
                        <div class="form-group row">
                                <label for="political_position" class="col-md-4 col-form-label text-md-right">{{ __('What is your political orientation? *You can choose "Don\'t know"*') }}</label>
    
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
