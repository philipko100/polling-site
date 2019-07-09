@extends('layouts.app')

@section('content')
        {!! Form::open(['action' => 'SearchesController@search', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
                {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search For Reviews'])}}
                <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
        {!! Form::close() !!}
        @if(count($figures) > 0)
                <b>Scores go from -10 to 10. </b>
                @foreach($figures as $figure)
                        <div class = "well well-lg">
                                <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                                <img style="width:50%" src="/storage/cover_images/{{$figure->cover_image}}">
                                        </div>
                                        <div class="col-md-8 col-sm-8">
                                                <h3><a href="/figures/{{$figure->id}}"> {{$figure->first_name}} {{$figure->last_name}}</a> <br>Overall Score: {{$figure->overall_rating}}</h3> 
                                                Public trust score: {{$figure->public_trust_rating}} | 
                                                {{$figure->self_position}}
                                        </div>
                                </div> 
                                <br>
                        </div>
                @endforeach
                {{$figures->links()}}
        @else
                <p>No figures up yet</p>
        @endif
        <br>
        <div class="jumbotron text-center">
                @guest
                        <p> <a class='btn btn-primary btn-lg' href="/login" role="button">Login</a> <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a></p>
                @else
                        <!--- if user ids are less than 10 (meaning they are website admins) they are able to add/edit figures --->
                        @if( Auth::user()->id < 10 )
                                @if(count($figures) > 0)
                                        <table class = "table table-striped">
                                                <tr>
                                                        <th>Figures</th>
                                                        <th></th>
                                                        <th></th>
                                                </tr>
                                                @foreach($figures as $figure)
                                                        <tr>
                                                                <td><a href="/figures/{{$figure->id}}" >{{$figure->first_name}} {{$figure->last_name}}</a></td>
                                                                <td><a href="/figures/{{$figure->id}}/edit" class="btn btn-default">Edit</a></td>
                                                                <td>            
                                                                        {!!Form::open(['action'=>['PagesController@destroy', $figure->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                                                                {{Form::hidden('_method', 'DELETE')}}
                                                                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                                                        {!!Form::close() !!}
                                                                </td>
                                                        </tr>
                                                @endforeach
                                        </table>
                                @else
                                        <p>You have no reviews. :(</p>
                                @endif
                                <a href="/figures/create">Add A New Figure</a>  
                        @endif
                @endguest
        </div>
@endsection