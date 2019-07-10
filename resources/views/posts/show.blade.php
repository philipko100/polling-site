@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default" >Go Back</a>
    <div class="container">
            <div class="row">
                   <div class="col-md">
    <h3><b>{{$figure->first_name}} {{$figure->last_name}}</b></h3>
    <h1>{{$post->title}}</h1>
    
    <h3><b>Rating of review: {{$post->rating}}</b></h3>
    Overall Rating of {{$figure->first_name}} {{$figure->last_name}}: {{$figure->overall_rating}}
    <h3><b>Trustworthiness rating: {{$post->trustworthiness}}</b></h3>
    Public trust rating of {{$figure->first_name}} {{$figure->last_name}}: {{$figure->public_trust_rating}}
    <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
    
                   </div>
    
                   <div class="col-md">
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit Rating</a>
    
            {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete Rating', ['class'=>'btn btn-danger'])}}
            {!!Form::close() !!}
         @endif
    @endif

                   </div>
            </div>
    </div>

    <br><br>

    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->username}} </small>
    <hr>
    Comments:
    @foreach($comments as $comment)
    <div class="shadow-sm p-4 mb-4 bg-light">
            <div class = "well well-sm">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                            {{$comment->body}}<br>
                            <small>Written on {{$comment->created_at}} by {{$comment->username}} </small>
                    </div>
                    @if(!Auth::guest())
                        @if(Auth::user()->id == $comment->user_id)
                    <div class="float-sm-right">
                            <div class="row">
                                    {!!Form::open(['action'=>['CommentsController@edit', $comment->id], 'method'=>'GET', 'class'=>'pull-right'])!!}
                                        
                                        {{Form::submit('Edit', ['class'=>'btn btn-secondary btn-sm'])}}
                                    {!!Form::close() !!}
                                

                             {!!Form::open(['action'=>['CommentsController@destroy', $comment->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                            {!!Form::close() !!}

                            @endif
                            @endif
                            </div>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
     {{$comments->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    
     
     <!--- only users are allowed to comment -->
     @if(!Auth::guest())
     <div class="container">
     <div class="row">

    {!!Form::open(['action'=>['CommentsController@store'], 'method'=>'POST', 'class'=>'pull-right'])!!}
        {{Form::text('body', '', ['class'=>'form-control', 'placeholder'=>'Comment on the review here'])}}
        <input type = 'hidden' name = 'post_id' value = '{{$post->id}}'>
        <input type = 'hidden' name = 'post_title' value = '{{$post->title}}'>
        <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
        <input type = 'hidden' name = 'username' value = '{{Auth::user()->username}}'>

        {{Form::submit('Comment', ['class'=>'btn btn-secondary btn-sm'])}}
    {!!Form::close() !!}

           
     </div>
    </div>
    @else
        <br><br>
        You need to create an account to comment on reviews. Don't worry, it only takes 2 minutes!
    @endif
    
@endsection