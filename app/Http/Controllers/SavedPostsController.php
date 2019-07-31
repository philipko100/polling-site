<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\SavedPost;
use App\User;
use DB;

use Illuminate\Support\Facades\Auth;

class SavedPostsController extends Controller
{
    /** Take this whole section till the next comment section to allow nonusers to post
     * Create a new controller instance.
     *
     * @return void
     *
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    */

    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $savedposts = $user->savedposts;
        $savedposts = $savedposts->sortByDesc('created_at');

        return view('posts.saved')
        ->with('savedposts', $savedposts);
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
            'user_id' => 'required',
            'post_id' => 'required',
            'post_title' => 'required'
        ]);

        if(!Auth::Guest()){
        $savedpost = new SavedPost;
        $savedpost->user_id = $request->input('user_id');
        $savedpost->post_id = $request->input('post_id');
        $savedpost->post_title = $request->input('post_title');
        $savedpost->save();
        }
        $beforeurl = $_SERVER['HTTP_REFERER'];
        return redirect($beforeurl)->with('success', 'Post Saved');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = SavedPost::find($id);
        $user_id =$post->user_id;

        // Check for correct user
        if(auth()->user()->id == $user_id){
            $post->delete();
            return redirect("/profile/$user_id/saved")->with('success', 'Post Unsaved');
        }

        //send error if not the correct user
        if(auth()->user()->id !== $user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

    }
}
