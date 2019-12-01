@extends('layouts.app')

@section('content')
<review-index>
    <h1>All Ratings</h1>

    {!! Form::open(['action' => 'SearchesController@search', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
        {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search for ratings..'])}}
        <button class="btn aqua-gradient btn-rounded btn-sm btn-light ml-1" type="submit">
            <i class="fas fa-search"></i>
        </button>
    {!! Form::close() !!}
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                            @if($post->cover_image != "noimage.jpg")
                                <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
                            @endif
                    </div>
                    <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a> <br>
                                Rating: {{$post->rating}}%
                                {!!Form::open(['action'=>['SavedPostsController@store'], 'method'=>'POST', 'class'=>'pull-right', 'style'=>'float:right;'])!!}
                                    <input type = 'hidden' name = 'post_id' value = '{{$post->id}}'>
                                    <input type = 'hidden' name = 'post_title' value = '{{$post->title}}'>
                                    @if(!Auth::guest())
                                        <input type = 'hidden' name = 'user_id' value = '{{Auth::user()->id}}'>
                                    @else
                                        <input type = 'hidden' name = 'user_id' value = '0'>
                                    @endif
                                    {{Form::submit('Save Post', ['class'=>'btn btn-secondary btn-sm'])}}
                                {!!Form::close() !!}
                            </h3> 
                            <h4><grey>Review of:</grey> <a href="/figures/{{$post->figure_id}}">{{$post->figure_name}}</a></h4><br>
                            <small>Written on {{$post->created_at}} 
                                by <a href="/profile/username/{{$post->username}}">{{$post->username}}</a> </small>
                    </div>
                </div>
                
            </div>
            <hr style="background-color: #51B2C9;">
        @endforeach
        {{$posts->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    @else
        <p>No posts found.</p>
    @endif
</review-index>
@endsection