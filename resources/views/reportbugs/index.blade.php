@extends('layouts.app')

@section('content')
    <h1>Reported Bugs</h1>

    @if(count($reports) > 0)
        @foreach($reports as $report)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                            <h3>{{$report->title}}</h3> 
                            @if($report->cover_image != "noimage.jpg")
                                <img style="width:50%" src="/storage/cover_images/report_bugs/{{$report->cover_image}}">
                            @endif
                            <br>
                            {{$report->body}}<br>
                            <small>Reported on {{$report->created_at}}</small>
                            <br><br>
                    </div>
                </div>
                
            </div>
        @endforeach
        {{$reports->links()}} <!-- this is to create the buttons for the paginated number buttons -->
    @else
        <p>No reports found.</p>
    @endif
@endsection