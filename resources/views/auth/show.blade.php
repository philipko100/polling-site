@extends('layouts.app')

@section('content')
@if(!Auth::guest())
    @if(Auth::user()->id == $user->id)
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-default">Edit Profile</a>
                </div>
            </div>
        </div>
    @endif

    <h1>{{$user->name}}</h1>

    <br><br>
    <p>Username: {{$user->username}} <br>
        Email: {{$user->email}}<br>
        Political Position: {{$user->political_position}}<br>
        Birth Date: {{$user->birth_date}}<br>
        Gender: {{$user->gender}}<br>
        <br>
        <b>Other Information</b><br>
        Occupation: {{$user->occupation}}<br>
        Income level: {{$user->income_level}}<br>
        Education level: {{$user->education_level}}<br>
        Race/Origin: {{$user->race_origin}}<br>
        Religion: {{$user->religion}}<br>
        <br>
        <b>Your current location</b><br>
        Current City: {{$user->current_city}}<br>
        Current Province or State: {{$user->current_province}}<br>
        Current Country: {{$user->current_country}}<br>
        <br>
        <b>Your hometown location</b><br>
        Hometown City: {{$user->hometown_city}}<br>
        Hometown Province or State: {{$user->hometown_province}}<br>
        Hometown Country: {{$user->hometown_country}}<br>
    </p>
    @else
        You need to log in to view other people's profiles
@endif
@endsection