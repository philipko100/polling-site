@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Viewing Saved</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Saved</h3>
                    <br>
                    @if(count($savedposts) > 0)
                    <table class = "table table-striped">
                        <tr>
                            <th>Ratings You Have Saved</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($savedposts as $savedpost)
                            <tr>
                                <td><a href="/posts/{{$savedpost->post_id}}">{{$savedpost->post_title}}</a></td>
                                <td>{!!Form::open(['action'=>['SavedPostsController@destroy', $savedpost->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Unsave', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close() !!}</td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You did not save any post. :(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
