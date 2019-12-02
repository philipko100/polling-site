@extends('layouts.app')

@section('content')
<div class="page-content">
<div class="ReviewsContainer" style="color:#00B4CC;">
        <div class="section-1">
                <h1> Election Candidates </h1>
                <h2> Scores</h2>
                <ol>
                    @foreach($electionFigures as $eFigure)
                    <li> <a href="/figures/{{$eFigure->id}}" style="color:#00B4CC">{{$eFigure->first_name}} {{$eFigure->last_name}}: {{$eFigure->overall_rating}}% </a></li>
                    @endforeach
                </ol>
            </div>

</div>
<div class="post">
    <div class="container">
            <div class="row">
                   <div class="col-md-8 col-sm-8">
                        <div class="text-center">
                        <h3><grey>This is a rating of </grey><b>
                            <a href="/figures/{{$figure->id}}" style="color:white;">{{$figure->first_name}} {{$figure->last_name}}</a></b></h3>
                      
                        <hr style="background-color: #51B2C9;">
                     
    <h1>{{$post->title}}</h1>
                        
    <div class="FigureScore" style="margin-left: 10%">
    <h4>Rating: {{$post->rating}}%</h4>
    </div>
    <div class="TrustScore">
    <h4>Trustworthiness rating: {{$post->trustworthiness}}%</h4>
    </div>
    <br>
                        
    Public Overall Rating of {{$figure->last_name}}: {{$figure->overall_rating}}% | 
    Public Trust Rating of {{$figure->last_name}}: {{$figure->public_trust_rating}}%
    @if($post->cover_image != "noimage.jpg")
        <img style="max-width:450px;" src="/storage/cover_images/{{$post->cover_image}}">
    @endif
                        </div>
                   </div>
    
                   <div class="col-md-4 col-sm-4">
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary btn-sm" style="float:right;">Edit Rating</a>
    
            {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right', 'style'=>'float:right;'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete Rating', ['class'=>'btn btn-danger'])}}
            {!!Form::close() !!}
         @endif
    @endif

    
                            {!!Form::open(['action'=>['SavedPostsController@store'], 'method'=>'POST', 'class'=>'pull-right', 'style'=>'float:right;'])!!}
                                <input type = 'hidden' name = 'post_id' value = '{{$post->id}}'>
                                <input type = 'hidden' name = 'post_title' value = '{{$post->title}}'>
                                @if(!Auth::guest())
                                <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                @endif
                                {{Form::submit('Save Post', ['class'=>'btn btn-secondary btn-sm'])}}
                            {!!Form::close() !!}
                            

                   </div>
            </div>
    </div>

    <br><br>

    <div>
        {!!$post->body!!}
    </div>
   
    <small>Written on {{$post->created_at}} 
        by <a href="/profile/username/{{$post->username}}">{{$post->username}}</a> </small> 
    <hr style="background-color: #51B2C9;">
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
                    
                    <div class="col-md-4 col-sm-4">
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
                        <br><br>
                            {!!Form::open(['action'=>['SavedCommentsController@store'], 'method'=>'POST', 'class'=>'pull-right', 'style'=>'float:right;'])!!}
                                <input type = 'hidden' name = 'post_id' value = '{{$comment->post_id}}'>
                                <input type = 'hidden' name = 'comment_id' value = '{{$comment->id}}'>
                                @if(!Auth::guest())
                                <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                @endif
                                {{Form::submit('Save Comment', ['class'=>'btn btn-secondary btn-sm'])}}
                            {!!Form::close() !!}

                    
                    </div>
         
                        
                        
                        
   
            </div>
            <a href="/comment/{{$comment->id}}/subcomments"> 
                <div class="text-center">View Subcomments </div>
            </a>
    </div>
    </div>
    @endforeach
     {{$comments->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    
     
     <!--- only users are allowed to comment -->
     @if(!Auth::guest())
     <div class="container">
     <div class="row">

    {!!Form::open(['action'=>['CommentsController@store'], 'method'=>'POST', 'class'=>'pull-right'])!!}
        {{Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'Comment on the review here','style'=>'width:100%; height:40%'])}}
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
</div>
@endsection