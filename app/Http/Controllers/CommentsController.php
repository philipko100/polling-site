<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment; //import model
use App\Post; //import model
use App\Figure; //import model
use DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $comment = new Comment;
        $comment->post_id = $request->input('post_id');
        $comment->post_title = $request->input('post_title');
        $comment->user_id = $request->input('user_id');
        $comment->username = $request->input('username');
        $comment->body = $request->input('body');

        $comment->save();

        return redirect("/posts/$comment->post_id")->with('success', 'Comment Success');
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
        $user_comment = Comment::find($id);

        $post_id = $user_comment->post_id;
        $post = Post::find($post_id);

        $figure_idOb = DB::table('posts')
            ->select('figure_id')
            ->where('id', $post_id)
            ->first();
        $figure_id = $figure_idOb->figure_id;
        $figure = Figure::find($figure_id);

        $comments = DB::table('comments')
            ->where('post_id', $post_id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);


        // Check for correct user
        if(auth()->user()->id == $user_comment->user_id){
            return view('comments.edit')
            ->with('post', $post)
            ->with('figure', $figure)
            ->with('comments', $comments)
            ->with('user_comment', $user_comment);
        }

        if(auth()->user()->id !== $user_comment->user_id){
            return redirect("/posts/$user_comment->post_id")->with('error', 'Unauthorized page');
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
        $comment = Comment::find($id);
        $comment->body = $request->input('body');

        $comment->save();

        return redirect("/posts/$comment->post_id")->with('success', 'Comment Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post_id;

        // Check for correct user
        if(auth()->user()->id == $comment->user_id){
            $comment->delete();
            return redirect("/posts/$post_id")->with('success', 'Post Removed');
        }


        if(auth()->user()->id !== $comment->user_id){
            return redirect("/posts/$post_id")->with('error', 'Unauthorized page');
        }
    }
}
