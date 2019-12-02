<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\SavedComment;
use App\User;
use DB;

use Illuminate\Support\Facades\Auth;


class SavedCommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::Guest()) {
            return redirect('/login')->with('error', 'You need to log in to save something');
        }
        
        $this->validate($request, [
            'user_id' => 'required',
            'post_id' => 'required',
            'comment_id' => 'required'
        ]);

        if(!Auth::Guest()){
            $savedcomments = new SavedComment;
            $savedcomments->user_id = $request->input('user_id');
            $savedcomments->post_id = $request->input('post_id');
            $savedcomments->comment_id = $request->input('comment_id');
            $savedcomments->save();
        }
        $beforeurl = $_SERVER['HTTP_REFERER'];
        return redirect($beforeurl)->with('success', 'Comment Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $savedcomment = SavedComment::find($id);
        $user_id =$savedcomment->user_id;

        // Check for correct user
        if(auth()->user()->id == $user_id){
            $savedcomment->delete();
            return redirect("/profile/$user_id/saved")->with('success', 'Comment Unsaved');
        }

        //send error if not the correct user
        if(auth()->user()->id !== $user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

    }
}
