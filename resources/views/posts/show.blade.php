@extends('layouts.app')

@section('content')
<div class="post">
    <a href="/posts" class="btn btn-default" >Go Back</a>
    <div class="container">
            <div class="row">
                   <div class="col-md">
    <h3><b>{{$figure->first_name}} {{$figure->last_name}}</b></h3>
    <h1>{{$post->title}}</h1>
    
    <h3><b>Rating of review: {{$post->rating}}%</b></h3>
    Overall Rating of {{$figure->first_name}} {{$figure->last_name}}: {{$figure->overall_rating}}%
    <h3><b>Trustworthiness rating: {{$post->trustworthiness}}%</b></h3>
    Public trust rating of {{$figure->first_name}} {{$figure->last_name}}: {{$figure->public_trust_rating}}%
    @if($post->cover_image != "noimage.jpg")
        <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
    @endif
    
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

    @if(!Auth::guest())
                            {!!Form::open(['action'=>['SavedPostsController@store'], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                <input type = 'hidden' name = 'post_id' value = '{{$post->id}}'>
                                <input type = 'hidden' name = 'post_title' value = '{{$post->title}}'>
                                <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                {{Form::submit('Save Post', ['class'=>'btn btn-secondary btn-sm'])}}
                            {!!Form::close() !!}
                            @endif

                   </div>
            </div>
    </div>

    <br><br>

    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} 
        by <a href="/profile/username/{{$post->username}}">{{$post->username}}</a> </small> 
    <hr>
    Comments:
    @foreach($comments as $comment)
    <div class="shadow-sm p-4 mb-4 bg-light">
            <div class = "well well-sm">
                <div class="row">
                    <div class="col-md-8 col-sm-8" style="color:black;">
                            {{$comment->body}}<br>
                            <small>Written on {{$comment->created_at}} 
                                by <a href="/profile/username/{{$comment->username}}">{{$comment->username}}</a> </small>
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
                            </div>
                        </div>
                        @endif
                    @endif
                    <a href="/comment/{{$comment->id}}/subcomments">View subcomments</a>
                    @if(!Auth::guest())
                            {!!Form::open(['action'=>['SavedCommentsController@store'], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                <input type = 'hidden' name = 'post_id' value = '{{$comment->post_id}}'>
                                <input type = 'hidden' name = 'comment_id' value = '{{$comment->id}}'>
                                <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                {{Form::submit('Save Comment', ['class'=>'btn btn-secondary btn-sm'])}}
                            {!!Form::close() !!}
                    @endif
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
        You need to create an account to comment on reviews. Don't worry, it only takes a minute and you can log in with your Google or Facebook account!
    @endif
</div>    
@endsection