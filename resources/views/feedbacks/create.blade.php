@extends('layouts.app')

@section('content')
<div class="row">
    <h1>Give Recommendations & Feedback</h1>
    <br>
</div>
    {!! Form::open(['action' => 'FeedbacksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'e.g. Create a Feedback or Recommendation page!'])}}
        </div>

        How would you score the website?
        <select name = "website_rating" class="custom-select">
            <option value = 5 disabled selected>Choose your overall rating</option> 
            <option value = 100>100% rating - Best Website Ever</option>
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
        <br><br>
        <div class="form-group">
                {{Form::label('body', 'Feedback/Recommendation:')}}
                <p>Best if you can answer questions such as, "What specifically would you like the website to do?", "How would users use this change?", "Are there other websites that do this?" and "Why do you want this change?"</p>
                {{Form::textarea('body', '', ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        Upload a picture/screenshot if you wish:
        <div class = "form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection