@extends('layouts.app')

@section('content')
        {!! Form::open(['action' => 'SearchesController@figureSearch', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
                {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search For Figures'])}}
                <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
        {!! Form::close() !!}
        @if(count($figures) > 0)
                <b>Scores go from -10 to 10. </b>


                        <div class = "well well-lg">
                                <div class="row">


                                  @foreach($figures as $figure)


                                        <div class="col-md-2 col-sm-2">
                                                <img style="width:50%" src="/storage/cover_images/{{$figure->cover_image}}">
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                                <h3><a href="/figures/{{$figure->id}}"> {{$figure->first_name}} {{$figure->last_name}}</a> <br>Overall Score: {{$figure->overall_rating}}</h3>
                                                Public trust score: {{$figure->public_trust_rating}} |
                                                {{$figure->self_position}}
                                        </div>


                                    @endforeach


                                </div>
                                <br>
                        </div>


                {{$figures->links()}}
        @else
                <p>No figures found.</p>
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
                                                        <th> Editing Figures does not cause the disruption that deleting does. </th>
                                                        <th>We advise you against delete figures as it would delete all of their ratings, comments, and subcomments.</th>
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
                                        <p>There are no figures. :(</p>
                                @endif
                                <a href="/figures/create">Add A New Figure</a>
                        @endif
                @endguest
        </div>
@endsection
