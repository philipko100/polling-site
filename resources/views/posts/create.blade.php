@extends('layouts.app')

@section('content')
<post-review>
    <h1>Create Post</h1>
    <h3>You are rating <b>{{$figure->first_name}} {{$figure->last_name}}.</b></h3>
    <br>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'e.g. This News Figure Is Not Reliable'])}}
        </div>
        How would you score {{$figure->first_name}} {{$figure->last_name}} overall?
        <select name = "rating" class="custom-select">
            <option value = 5 disabled selected>Choose your overall rating</option> 
            <option value = 100>100% rating - Best</option>
            <option value = 90>90%</option>
            <option value = 80>80%</option>
            <option value = 70>70% - Pretty good</option>
            <option value = 60>60%</option>
            <option value = 50>50% - Neutral</option>
            <option value = 40>40%</option>
            <option value = 30>30% - Pretty bad</option>
            <option value = 20>20%</option>
            <option value = 10>10%</option>
            <option value = 0>0% - Hate it</option>
        </select>
        <br><br><br>
        How would you score {{$figure->first_name}} {{$figure->last_name}}'s trustworthiness?
        <select name = "trustworthiness" class="custom-select">
                <option value = 5 disabled selected>How trustworthy is {{$figure->first_name}} {{$figure->last_name}}? *optional*</option> 
                <option value = 100>100% - Always tells the truth</option>
                <option value = 90>90%</option>
                <option value = 80>80%</option>
                <option value = 70>70% - Small lies infrequently</option>
                <option value = 60>60%</option>
                <option value = 50>50% - Lies from time to time</option>
                <option value = 40>40%</option>
                <option value = 30>30% - Small lies frequently & big lies infrequently</option>
                <option value = 20>20%</option>
                <option value = 10>10%</option>
                <option value = 0>0% - Big lies all the time</option>
            </select>
        <br><br><br>
        Where do you think {{$figure->first_name}} {{$figure->last_name}} stand in the political compass? (The options are organized from the right to left dimension) *optional*
        <select name = "political_position" class="custom-select">
                <option value = "" disabled selected>Choose political position *optional*</option> 
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
            </select>

        <br>
        <br>
        <br>
        <br>


        <div class="form-group">
                {{Form::label('body', 'Review *optional*:')}}
                <p>Best if you can answer questions such as, "How do you view this figure?", "Is this figure trustworthy?", "Is this figure respectable?", and "Do you have any specific information or annecdote to back up your claims?"</p>
                {{Form::textarea('body', '', ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>

        <input type = 'hidden' name = 'figure_id' value = '{{$figure->id}}'>
        Upload a relevant image if you wish *optional*
        <!----//upload file UI--->
        <div class = "form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
</post-review>
@endsection