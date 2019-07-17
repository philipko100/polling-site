@extends('layouts.app')

@section('content')
    <h1>Edit Figure</h1>
    {!! Form::open(['action' => ['PagesController@update', $figure->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                    {{Form::label('firstname', 'Figure\'s First Name')}}
                    {{Form::text('firstname', $figure->first_name, ['class'=>'form-control', 'placeholder'=>'e.g. Ben or CNN'])}}
            </div>
            <div class="form-group">
                    {{Form::label('lastname', 'Figure\'s Last Name: put "News" if it is a news agency')}}
                    {{Form::text('lastname', $figure->last_name, ['class'=>'form-control', 'placeholder'=>'e.g. Shapiro or News'])}}
            </div>
            <div class="form-group">
                        {{Form::label('occupation', "What is the $figure->first_name $figure->last_name's occupation?")}}
                        {{Form::text('occupation', $figure->occupation, ['class'=>'form-control', 'placeholder'=>'e.g. Political Commentator or News Agency or Journalist or Politician or etc.'])}}
                </div>
            What does {{$figure->first_name}} {{$figure->last_name}} self-identify as in the political compass? (The options are organized from the right to left dimension)
                <select name = "self_position" class="custom-select">
                <option value = "{{$figure->self_position}}" selected>{{$figure->self_position}}</option>
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
            <br><br>
            <div class="form-group">
                    {{Form::label('bio', 'Bio:')}}
                    <p>Best if you can answer questions such as, "What does this figure do?", "What does he/she/they believe politically and culturally?", "Who do this figure work with?", and "Do you have any more specific information or annecdote to back up your claims?"</p>
                    {{Form::textarea('bio', "$figure->bio", ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Enter bio here'])}}
            </div>
            Is this person currently campaigning for an election?
        <select name = "isInElection" class="custom-select">
                <option value = "" disabled selected>Choose</option> 
                <option value = 0>No</option>
                <option value = 1>Yes</option>
            </select>
        <br><br>
        <!----//upload file UI--->
        Upload a picture of the figure:
        <div class = "form-group">
                {{Form::file('cover_image')}}
        </div>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection