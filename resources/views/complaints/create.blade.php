@extends('layouts.app')

@section('content')
<div class="row">
    <h1>Send Complaint</h1>
    <br>
</div>
    {!! Form::open(['action' => 'ComplaintsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'e.g. The information about me in my figure profile is wrong'])}}
        </div>

        <div class="form-group">
                {{Form::label('body', 'Complaint:')}}
                <p>Best if you can answer questions such as, "Is there any information about you that is incorrect?", "What specifically about the website is bothering you?", "Is ther problem systemic?" and "How do you believe we can change this?"</p>
                {{Form::textarea('body', '', ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        Upload a picture/screenshot if you wish:
        <div class = "form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection