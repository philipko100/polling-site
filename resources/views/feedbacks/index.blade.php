@extends('layouts.app')

@section('content')
    <h1>Feedbacks</h1>

    @if(count($feedbacks) > 0)
        @foreach($feedbacks as $feedback)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                            <h3>{{$feedback->title}}</h3> 
                            @if($feedback->cover_image != "noimage.jpg")
                                <img style="width:50%" src="/storage/cover_images/feedbacks/{{$feedback->cover_image}}">
                            @endif
                            <br>
                            Rating: {{$feedback->website_rating}} <br>
                            {{$feedback->body}}<br>
                            <small>Reported on {{$feedback->created_at}}</small>
                            <br><br>
                    </div>
                </div>
                
            </div>
        @endforeach
        {{$feedbacks->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    @else
        <p>No reports found.</p>
    @endif
@endsection