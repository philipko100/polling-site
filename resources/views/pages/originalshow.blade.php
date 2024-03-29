@extends('layouts.app')

@section('content')
    <a href="/" class="btn btn-default" >Go Back</a>
    <h1>{{$figure->first_name}} {{$figure->last_name}}</h1>
    
    <h1><b>Overall Rating: {{$figure->overall_rating}}%</b></h1>
    <img style="width:30%" src="/storage/cover_images/{{$figure->cover_image}}">
    <br><br>
    <div>
        <h5><b>Trustworthiness: {{$figure->public_trust_rating}}%</b> 
        <b>{{$figure->first_name}} {{$figure->last_name}} self identifies as Political Position:</b> {{$figure->self_position}}<br>
        <b>Political Party Affiliation:</b> {{$figure->political_party}}<br>
        <b>Official Title:</b> {{$figure->official_title}}<br></h5>
        <b>Occupation:</b> {{$figure->occupation}}<br>
        
        @if($figure->isInElection)
            <b>Currently is in an election campaign.</b><br>
            <b>Election Scope:</b> {{$figure->election_scope}}<br>
            <b>Election Region:</b> {{$figure->election_region}}<br>
        @else
            <b>Currently not in an election campaign.</b><br>
        @endif
        <b>Bio:</b> {{$figure->bio}}
    </div>
    <hr>

    @if(count($posts) > 0)
        Scores go from 1 to 5: 1 being really bad to 5 being freaking awesome.
        @foreach($posts as $post)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                            @if(!Auth::guest())
                            {!!Form::open(['action'=>['SavedPostsController@store'], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                <input type = 'hidden' name = 'post_id' value = '{{$post->id}}'>
                                <input type = 'hidden' name = 'post_title' value = '{{$post->title}}'>
                                <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                {{Form::submit('Save Post', ['class'=>'btn btn-secondary btn-sm'])}}
                            {!!Form::close() !!}
                            @endif
                            <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                            <h5><a href="/posts/{{$post->id}}">{{$post->title}}</a> Overall Score: {{$post->rating}}%
                            Trustworthiness Score: {{$post->trustworthiness}}%</h5> <!-- assign id by alphabetical order --->
                            <p>They identify {{$figure->first_name}} {{$figure->last_name}} as {{$post->political_position}}.</p>
                            <small>Written on {{$post->created_at}} by 
                                        <a href="/profile/username/{{$post->username}}">{{$post->username}}</a> </small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    @else
        <p>There are no ratings of this figure.</p>
    @endif

    <div class="row">
            {!! Form::open(['action' => 'PostsController@create', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                <input type = 'hidden' name = 'id' value = '{{$figure->id}}'>
                <input type = 'hidden' name = 'name' value = '{{$figure->first_name}} {{$figure->last_name}}'>
                {{Form::submit('Rate this figure', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
    </div>


    
    @if(!Auth::guest())
        @if(Auth::user()->isAdmin)
            <a href="/figures/{{$figure->id}}/edit" class="btn btn-default">Edit Figure</a>
    
            {!!Form::open(['action'=>['PagesController@destroy', $figure->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete Figure', ['class'=>'btn btn-danger'])}}
            {!!Form::close() !!}
         @endif
    @endif
@endsection