@extends('layouts.app')

@section('content')

<div class="page-content">
    <div class="Profile-Container">
        <div class="profile">
            <div class="image-container">
                <!--   <img style="width:30%" src="/storag"> -->
                <img src="/storage/cover_images/{{$figure->cover_image}}">
            </div>
            <h2>{{$figure->first_name}} {{$figure->last_name}}</h2>
            <h3>{{$figure->occupation}}</h3>
            <h3>{{$figure->official_title}}</h3>
            <h3> {{$figure->first_name}} {{$figure->last_name}} politically self identifies himself as a: {{$figure->self_position}} </h3>
			<h3> Overall Rating: {{$figure->overall_rating}}% </h2>
			<h3> Trustworthiness score: {{$figure->public_trust_rating}}% </h2>
            @if($figure->isInElection)
                <h4>Currently is in an election campaign.</h4>
                <h4>Election Scope: {{$figure->election_scope}}</h4>
                <h4>Election Region: {{$figure->election_region}}</h4>
            @else
                <h4>Currently not in an election campaign.</h4>
            @endif 
            <p>{{$figure->bio}}</p>
        </div>
    </div>

    <div class="reviews-section">
        <div class="ReviewsLabel">
            <h2> Reviews </h2>
        </div>
        <div class="text-right"> 
        {!! Form::open(['action' => 'PostsController@create', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                <input type = 'hidden' name = 'id' value = '{{$figure->id}}'>
                <input type = 'hidden' name = 'name' value = '{{$figure->first_name}} {{$figure->last_name}}'>
                {{Form::submit('Rate this figure!', ['class'=>'btn btn-primary'])}}
         {!! Form::close() !!}
        </div>
        <div class="post-section">
            @if(count($posts) > 0)
                @foreach($posts as $post)
                <div class="individual-posts">
                    <a href="/posts/{{$post->id}}">
                        @if($post->cover_image != "noimage.jpg")
                            <img src="/storage/cover_images/{{$post->cover_image}}">
                        @endif
                    </a> 
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a>  <span style="font-size: 10px;"> Written by <a href="/profile/username/{{$post->username}}">{{$post->username}}</a> </span> </h3>
                    <a href="/posts/{{$post->id}}">
                        <h4>Overall Score: {{$post->rating}}%</h4>
                        <h4> Trustworthiness score: {{$post->trustworthiness}}% </h4>
                        <p> They identify {{$figure->first_name}} {{$figure->last_name}} as {{$post->political_position}} | Written on {{$post->created_at}}</p>
                    </a>
			        @if(!Auth::guest())
                            {!!Form::open(['action'=>['SavedPostsController@store'], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                <input type = 'hidden' name = 'post_id' value = '{{$post->id}}'>
                                <input type = 'hidden' name = 'post_title' value = '{{$post->title}}'>
                                <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                {{Form::submit('Save Post', ['class'=>'btn btn-secondary btn-sm'])}}
                            {!!Form::close() !!}
                    @endif
                 </div>
                 @endforeach
                 {{$posts->links()}} <!-- this is to create the buttons for the paginated number buttons -->
             @else
             <p>There are no ratings of this figure.</p>
             @endif
         </div>
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