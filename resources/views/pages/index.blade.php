@extends('layouts.appNoTopNavbar')

@section('content')
        @if(count($figures) > 0)
                <div class="page-content">
                        <div class="HeaderContainer">
                                        <a href="/"><h1> {{ config('app.name','RateYourCourse') }} </h1></a>
                                        <ul class="main-nav">
                                
                                        {!! Form::open(['action' => 'SearchesController@figureSearch', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto ml-2"]) !!}
                                        <div class="wrap">
                                           <div class="search">
                                              <input type="text" name='search' id='search' class="searchTerm" placeholder="Search figures..">
                                              <button type="submit" class="searchButton">
                                                <i class="fa fa-search"></i>
                                             </button>
                                           </div>
                                        </div>
                                        {!! Form::close() !!}
                                        <li><a href="/posts">Feed</a></li>
                                <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    Info <span class="caret"></span>
                                                </a>
                        
                                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="background-color:#13202C;">
                                                        <a class="dropdown-item" href="/about">
                                                         {{ __('About Us') }}
                                                        </a>
                                                        <a class="dropdown-item" href ="{{ route('politicaldefinitions') }}">
                                                            {{ __('Political Definitions') }}
                                                        </a>
                                                </div>
                                            </li>
                                <li class="nav-item dropdown">
                                                        <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                            Report <span class="caret"></span>
                                                        </a>
                                
                                                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="background-color:#13202C;">
                                                                <a class="dropdown-item" href="{{ route('reportbugs.create') }}">
                                                                 {{ __('Report Bugs') }}
                                                                </a>
                                                                <a class="dropdown-item" href ="{{ route('feedbacks.create') }}">
                                                                    {{ __('Feedback or Recommendation') }}
                                                                </a>
                                                                <a class="dropdown-item" href ="{{ route('complaints.create') }}">
                                                                  {{ __('Complaint') }}
                                                              </a>
                                                        </div>
                                 </li>
		                <!-- Authentication Links -->
                                @guest
                                <li class="nav-item">
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
          
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="background-color:#13202C;">
                                            <a class="dropdown-item" href="/dashboard">
                                             {{ __('Dashboard') }}
                                            </a>
                                            <a class="dropdown-item" href ="/profile/{{Auth::user()->id}}">
                                                {{ __('Profile') }}
                                            </a>
                                            <a class="dropdown-item" href ="/profile/{{Auth::user()->id}}/saved">
                                              {{ __('View Saved') }}
                                          </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
          
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
	                        </ul>
                        </div>

                        <div class="main-box">
                                  @foreach($figures as $figure)
                                        <div class="box">
                                        <a href="/figures/{{$figure->id}}">
                                            <!-- <div class="image" style="background-image:url('/storage/cover_images/{{$figure->cover_image}}');
                                              background-position:center center; background-size:cover; width:100%;height:100%" >
                                            </div> -->
                                            <img src='/storage/cover_images/{{$figure->cover_image}}' style="width:100%;height:70%">
                        
                                              <h3>{{$figure->first_name}} {{$figure->last_name}}<br>Overall Score: {{$figure->overall_rating}}%</h3>
                                              <p>Public trust score: {{$figure->public_trust_rating}}% |
                                              {{$figure->self_position}} </p>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                {{$figures->links()}}
        @else
                <p>No figures found.</p>
        @endif
        <br>
                @guest
                        <div class="sm-jumbotron text-center" style="background-color: #112D41; max-height: 0px;">
                        <p> <a class='btn btn-primary btn-lg' href="/login" role="button">Login</a> <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a></p>
                        </div>
                @else
                        <!--- if they are website admins, they are able to add/edit figures --->
                        @if(Auth::user()->isAdmin)
                                <div class="jumbotron text-center">
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
                                        <p>No figures found.</p>
                                @endif
                                <a href="/figures/create">Add A New Figure</a>
                                </div>
                        @endif
                @endguest
@endsection
