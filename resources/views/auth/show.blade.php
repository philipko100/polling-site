@extends('layouts.app')

@section('content')
@if(!Auth::guest())
@if(Auth::user()->id == $userid)
<div class="container">
    <div class="row">
           <div class="col-md">
    <h1>{{Auth::user()->name}}</h1>
</div>
    
<div class="col-md">
<a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-default">Edit Profile</a>

</div>
</div>
</div>
    <br><br>
    <p>Username: {{Auth::user()->username}} <br>
        Email: {{Auth::user()->email}}<br>
        Political Position: {{Auth::user()->political_position}}<br>
        Birth Date: {{Auth::user()->birth_date}}<br>
        Gender: {{Auth::user()->gender}}<br>
        <br>
        <b>Other Information</b><br>
        Occupation: {{Auth::user()->occupation}}<br>
        Income level: {{Auth::user()->income_level}}<br>
        Education level: {{Auth::user()->education_level}}<br>
        Race/Origin: {{Auth::user()->race_origin}}<br>
        Religion: {{Auth::user()->religion}}<br>
        <br>
        <b>Your current location</b><br>
        Current City: {{Auth::user()->current_city}}<br>
        Current Province or State: {{Auth::user()->current_province}}<br>
        Current Country: {{Auth::user()->current_country}}<br>
        <br>
        <b>Your hometown location</b><br>
        Hometown City: {{Auth::user()->hometown_city}}<br>
        Hometown Province or State: {{Auth::user()->hometown_province}}<br>
        Hometown Country: {{Auth::user()->hometown_country}}<br>
    </p>
    @endif
@endif
@endsection