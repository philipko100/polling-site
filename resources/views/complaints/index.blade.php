@extends('layouts.app')

@section('content')
    <h1>Complaints</h1>

    @if(count($complaints) > 0)
        @foreach($complaints as $complaint)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                            <h3><b>{{$complaint->title}}</b></h3> 
                            @if($complaint->cover_image != "noimage.jpg")
                                <img style="width:50%" src="/storage/cover_images/complaints/{{$complaint->cover_image}}">
                            @endif
                            <br>
                            {{$complaint->body}}<br>
                            <small>Reported on {{$complaint->created_at}}</small>
                            <br><br>
                    </div>
                </div>
                
            </div>
        @endforeach
        {{$complaints->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    @else
        <p>No reports found.</p>
    @endif
@endsection