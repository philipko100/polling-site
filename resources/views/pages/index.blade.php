@extends('layouts.app')

@section('content')
        @if(count($figures) > 0)
                <b>Scores are a percentage out of 100%. </b>
                        <div class = "well well-lg">
                                <div class="row">
                                  @foreach($figures as $figure)
                                    <div class="col-md-4 col-sm-12" style="margin-bottom:15px;">
                                      <div class="row">
                                      <div class="col-md-6 col-sm-6" style="padding:0px">
                                        <a href="/figures/{{$figure->id}}">
                                            <div class="image" style="background-image:url('/storage/cover_images/{{$figure->cover_image}}');
                                              background-position:center center; background-size:cover; width:100%;height:100%" >
                                            </div>
                                          </a>
                                      </div>
                                      <div class="col-md-6 col-sm-6">
                                              <h3><a style="text-decoration:none"href="/figures/{{$figure->id}}"> {{$figure->first_name}} {{$figure->last_name}}</a> <br>Overall Score: {{$figure->overall_rating}}%</h3>
                                              Public trust score: {{$figure->public_trust_rating}}% |
                                              {{$figure->self_position}}
                                      </div>
                                    </div>
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
