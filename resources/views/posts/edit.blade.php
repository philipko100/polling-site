@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <h3>You are rating <b>{{$figure->first_name}} {{$figure->last_name}}.</b></h3>
    <br>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>'e.g. This News Figure Is Not Reliable'])}}
    </div>
    How would you score {{$figure->first_name}} {{$figure->last_name}} overall?
    <select name = "rating" class="custom-select">
            <option value = "{{$post->rating}}" selected>{{$post->rating}}
            <option value = 5>5 stars - Best</option>
            <option value = 4>4 stars</option>
            <option value = 3>3 stars</option>
            <option value = 2>2 stars - Pretty good</option>
            <option value = 1>1 stars</option>
            <option value = 0>0 stars - Neutral</option>
            <option value = -1>-1 stars</option>
            <option value = -2>-2 stars - Pretty bad</option>
            <option value = -3>-3 stars</option>
            <option value = -4>-4 stars</option>
            <option value = -5>-5 stars - Hate it</option>
        </select>
        <br><br>
        How would you score {{$figure->first_name}} {{$figure->last_name}}'s trustworthiness?
        <select name = "trustworthiness" class="custom-select">
                <option value = "{{$post->trustworthiness}}" selected>{{$post->trustworthiness}}
                <option value = 5>5 stars - Always tells the truth</option>
                <option value = 4>4 stars</option>
                <option value = 3>3 stars</option>
                <option value = 2>2 stars - Small lies infrequently</option>
                <option value = 1>1 stars</option>
                <option value = 0>0 stars - Lies from time to time</option>
                <option value = -1>-1 stars</option>
                <option value = -2>-2 stars - Small lies frequently & big lies infrequently</option>
                <option value = -3>-3 stars</option>
                <option value = -4>-4 stars</option>
                <option value = -5>-5 stars - Big lies all the time</option>
            </select>
            <br><br>
    Where do you think {{$figure->first_name}} {{$figure->last_name}} stand in the political compass? (The options are organized from the right to left dimension) *optional*
        <select name = "political_position" class="custom-select">
                <option value = "{{$post->political_position}}" selected>{{$post->political_position}}</option>
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


    <div class="form-group">
            {{Form::label('body', 'Review *optional*:')}}
            <p>Best if you can answer questions such as, "How do you view this figure?", "Is this figure trustworthy?", "Is this figure respectable?", and "Do you have any specific information or annecdote to back up your claims?"</p>
            {{Form::textarea('body', $post->body, ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
    </div>

    <input type = 'hidden' name = 'figure_id' value = '{{$figure->id}}'>
    <input type = 'hidden' name = 'past_rating' value = '{{$post->rating}}'>
    <input type = 'hidden' name = 'past_trustworthiness' value = '{{$post->trustworthiness}}'>

        <!----//upload file UI--->
        <div class = "form-group">
                {{Form::file('cover_image')}}
        </div>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection