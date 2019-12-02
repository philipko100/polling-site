@extends('layouts.app')

@section('content')
<div class="page-content">
<div class="ReviewsContainer" style="color:#00B4CC;">
        <div class="section-1">
                <h1> Election Candidates </h1>
                <h2> Scores</h2>
                <ol>
                    @foreach($electionFigures as $figure)
                    <li> <a href="/figures/{{$figure->id}}" style="color:#00B4CC">{{$figure->first_name}} {{$figure->last_name}}: {{$figure->overall_rating}}% </a></li>
                    @endforeach
                </ol>
            </div>

</div>
<review-index>
    <h1>All Ratings</h1>

    {!! Form::open(['action' => 'SearchesController@search', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
        {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search for ratings..', 'style'=>'width:90%;'])}}
        <button class="btn aqua-gradient btn-rounded btn-sm btn-light ml-1" type="submit">
            <i class="fas fa-search"></i>
        </button>
    {!! Form::close() !!}
    <hr style="background-color: #51B2C9;">
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class = "well well-lg">
                <div class="row">
                    {{-- <div class="col-md-4 col-sm-4">
                            @if($post->cover_image != "noimage.jpg")
                                <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
                            @endif
                    </div> --}}
                    <div class="col-md-8 col-sm-8">
                            @if($post->cover_image != "noimage.jpg")
                            <img style="width:50%; height:50%; max-width: 400px;
                            height: auto;" src="/storage/cover_images/{{$post->cover_image}}">
                            <br><br>
                            @endif
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3> <br>
                            <h4>
                                <div class="FigureScore">
                                    Rating: {{$post->rating}}%
                                </div>
                                <div class="TrustScore">
                                    Trustworthiness Rating: {{$post->trustworthiness}}%
                                </div>
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
                            </h4> 
                            <h4><grey>Review of:</grey> <a href="/figures/{{$post->figure_id}}">{{$post->figure_name}}</a></h4><br>
                    </div>
                    <div class="row" style="margin-left: 10px;">
                          <p>{!!$post->body!!}</p> 
                    </div>
                    <div class="row" style="margin-left: 10px;">
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
</div>
@endsection