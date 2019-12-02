<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment; //import model
use App\Post; //import model
use App\Figure; //import model
use App\Subcomment;
use DB;

class SubcommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $comment = Comment::find($id);
        $post = Post::find($comment->post_id);

        $figure = Figure::find($post->figure_id);

        $comments = DB::table('comments')
            ->where('post_id', $comment->post_id)
            ->orderBy('created_at', 'desc')
            ->paginate(40);

        $subcomments = DB::table('subcomments')
            ->where('comment_id', $id)
            ->orderBy('created_at','desc')
            ->get();

        $electionFigures = Figure::where('isInElection', TRUE)
            ->orderBy('numOfReviews', 'desc')
            ->get();


        return view('subcomments.index')
        ->with('post', $post)
        ->with('figure', $figure)
        ->with('comments', $comments)
        ->with('subcomments', $subcomments)
        ->with ('supercomment', $comment)
        ->with('electionFigures', $electionFigures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Create Figure
        $subcomment = new Subcomment;
        $subcomment->post_id = $request->input('post_id');
        $subcomment->post_title = $request->input('post_title');
        $subcomment->comment_id = $request->input('comment_id');
        $subcomment->user_id = $request->input('user_id');
        $subcomment->username = $request->input('username');
        $subcomment->body = $request->input('body');

        $post = Post::find($request->input('post_id'));
        $post->numOfComments += 1;
        $post->save();

        $subcomment->save();
        return redirect("/comment/$subcomment->comment_id/subcomments")->with('success', 'Comment Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_subcomment = Subcomment::find($id);
        $supercomment = Comment::find($user_subcomment->comment_id);

        $post_id = $user_subcomment->post_id;
        $post = Post::find($post_id);

        $figure = Figure::find($post->figure_id);

        $comments = DB::table('comments')
            ->where('post_id', $post_id)
            ->orderBy('created_at', 'desc')
            ->paginate(40);
        
        $subcomments = DB::table('subcomments')
            ->where('comment_id', $user_subcomment->comment_id)
            ->orderBy('created_at','desc')
            ->get();

        $electionFigures = Figure::where('isInElection', TRUE)
            ->orderBy('numOfReviews', 'desc')
            ->get();

        // Check for correct user
        if(auth()->user()->id == $user_subcomment->user_id){
            return view('subcomments.edit')
            ->with('post', $post)
            ->with('figure', $figure)
            ->with('comments', $comments)
            ->with('user_subcomment', $user_subcomment)
            ->with('subcomments', $subcomments)
            ->with ('supercomment', $supercomment)
            ->with('electionFigures',$electionFigures);
        }

        if(auth()->user()->id !== $user_subcomment->user_id){
            return redirect("/posts/$user_subcomment->post_id")->with('error', 'Unauthorized page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Create Figure
        $subcomment = Subcomment::find($id);
        $subcomment->body = $request->input('body');

        $subcomment->save();

        return redirect("/comment/$subcomment->comment_id/subcomments")->with('success', 'Comment Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcomment = Subcomment::find($id);
        $post_id = $subcomment->post_id;

        // Check for correct user
        if(auth()->user()->id == $subcomment->user_id){
            $subcomment->delete();
            return redirect("/comment/$subcomment->comment_id/subcomments")->with('success', 'Post Removed');
        }


        if(auth()->user()->id !== $subcomment->user_id){
            return redirect("/comment/$subcomment->id/subcomments")->with('error', 'Unauthorized page');
        }
    }
}
