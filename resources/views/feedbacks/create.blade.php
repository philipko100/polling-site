@extends('layouts.app')

@section('content')
<div class="row">
    <h1>Give Recommendations & Feedback</h1>
    <br>
</div>
    {!! Form::open(['action' => 'FeedbacksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'e.g. I clicked the home button on the top bar and it lead me to an unexpected page'])}}
        </div>

        <div class="form-group">
                {{Form::label('body', 'Bug:')}}
                <p>Best if you can answer questions such as, "What specifically would you like the website to do?", "How would users use this change?", "Are there other websites that do this?" and "Why do you want this change?"</p>
                {{Form::textarea('body', '', ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection