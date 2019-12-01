@extends('layouts.app')

@section('content')
<div class="report">
<div class="row">
    <h1>Report Bug</h1>
    <br>
</div>
    {!! Form::open(['action' => 'ReportBugsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'e.g. I clicked the home button on the top bar and it lead me to an unexpected page'])}}
        </div>

        <div class="form-group">
                {{Form::label('body', 'Bug:')}}
                <p>Best if you can answer questions such as, "What were the steps that lead you to find this bug?", "What does this bug do?", and "Did it affect any of your content you have posted in the past?"</p>
                {{Form::textarea('body', '', ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        <!----//upload file UI--->
        Upload a picture/screenshot if you wish:
        <div class = "form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection