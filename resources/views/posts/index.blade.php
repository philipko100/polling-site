@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    {!! Form::open(['action' => 'SearchesController@search', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
        {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search Anything'])}}
        <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
    {!! Form::close() !!}
    @if(count($posts) > 0)
        Scores go from 1 to 5: 1 being really bad to 5 being freaking awesome.
        @foreach($posts as $post)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a> Rating: {{$post->rating}}</h3> <!-- assign id by alphabetical order --->
                            Review of: {{$post->figure_name}}<br>
                            <small>Written on {{$post->created_at}} by {{$post->username}} </small>
                    </div>
                </div>
                
            </div>
        @endforeach
        {{$posts->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    @else
        <p>No posts found</p>
    @endif
@endsection