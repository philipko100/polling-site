<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
          <a class="navbar-brand" style="color:white;" href="{{ url('/') }}">
              {{ config('app.name','RateYourCourse') }}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">


                {!! Form::open(['action' => 'SearchesController@figureSearch', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto ml-2"]) !!}
                <!-- <div class="wrap"> -->
                   <div class="search">
                      <input type="text" name='search' id='search' class="searchTerm" placeholder="Search figures..">
                      <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                     </button>
                   </div>
                <!-- </div> -->
                {!! Form::close() !!}

              <ul class="nav navbar-nav mr-auto">
                     <li class="nav-item">
                            <a class="nav-link" style="color:white;" href="/">Figures</a>
                     </li>
                      <li class="nav-item">
                          <a class="nav-link" style="color:white;" href="/posts">Reviews</a>
                      </li>
               </ul>

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color:white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Info <span class="caret"></span>
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/about">
                                     {{ __('About Us') }}
                                    </a>
                                    <a class="dropdown-item" href ="{{ route('politicaldefinitions') }}">
                                        {{ __('Political Definitions') }}
                                    </a>
                            </div>
                        </li>

                       <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color:white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Report <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                          <a class="nav-link" style="color:white;" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" style="color:white;" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color:white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
      </div>
  </nav>
