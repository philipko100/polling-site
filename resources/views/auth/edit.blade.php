@extends('layouts.app')

@section('content')
{!! Form::open(['action' => ['UsersController@update'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="container">
    <div class="row">
           <div class="col-md">
            <h1><input class="form-control" type="text" name="name" value="{{Auth::user()->name}}"></h1>
        </div>
    </div>
</div>
    <br><br>
    <p>
        Username: <input class="form-control" type="text" name="username" value="{{Auth::user()->username}}"> <br>
        Email: <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{Auth::user()->email}}">
        @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
        <br>
        Political Position: <select class="custom-select form-control" name="political_position">
                <option value="{{Auth::user()->political_position}}" selected>{{Auth::user()->political_position}}</option>
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
            </select><br><br>
        Birth Date: <input class="form-control" type="date" name="birth_date" value="{{Auth::user()->birth_date}}"><br>
        Gender: <select class="custom-select form-control" name="gender">
                <option value="{{Auth::user()->gender}}" selected>{{Auth::user()->gender}}</option>
                <option value = "male">Male</option>
                <option value = "female">Female</option>
                <option value = "other">Other</option>
            </select><br><br>
        Occupation: <input class="form-control" type="text" name="occupation" value="{{Auth::user()->occupation}}"><br>
        Income level: <input class="form-control" type="text" name="income_level" value="{{Auth::user()->income_level}}"><br>
        Education level: <select class="custom-select form-control" name="education_level">
                <option value="{{Auth::user()->education_level}}" selected>{{Auth::user()->education_level}}</option>
                <option value = "Graduated Middle School or less">Graduated Middle School or less</option>
                <option value = "Graduated High School">Graduated High School</option>
                <option value = "Bachelor's degree">Bachelor's degree</option>
                <option value = "Master's degree">Master's degree</option>
                <option value = "Doctor of Philosophy">Doctor of Philosophy</option>
                <option value = "Professional degree">Professional degree</option>
            </select><br><br>
        Race/Origin: <input class="form-control" type="text" name="race_origin" value="{{Auth::user()->race_origin}}"><br>
        <br>
        <b>Your current location</b><br>
        Current City: <input class="form-control" type="text" name="current_city" value="{{Auth::user()->current_city}}"><br>
        Current Province or State: <input class="form-control" type="text" name="current_province" value="{{Auth::user()->current_province}}"><br>
        Current Country: <input class="form-control" type="text" name="current_country" value="{{Auth::user()->current_country}}"><br>
    </p>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection