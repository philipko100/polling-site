<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Figure;
use App\Comment;
use App\Subcomment;
use DB;
use App\SavedPost;
use App\SavedComment;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(35);
        $electionFigures = Figure::where('isInElection', TRUE)
                            ->orderBy('numOfReviews', 'desc')
                            ->get();
        return view('posts.index')->with('posts',$posts)->with('electionFigures',$electionFigures);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::Guest()) {
            return redirect('/login')->with('error', 'You need to log in to post a rating');
        }
        $id = $request->input('id');
        $figure = Figure::find($id);
        return view('posts.create')->with('figure', $figure);
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
            'title' => 'required',
            'rating' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to Store with timestamp to make the name completely unique
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image/file
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->rating = $request->input('rating');
        $post->numOfComments = 0;
        if($request->input('body'))
            $post->body = $request->input('body');
        else
            $post->body = ' ';
        
        if($request->input('trustworthiness'))
            $post->trustworthiness = $request->input('trustworthiness');
        else
            $post->trustworthiness = 50;

        if($request->input('political_position'))
            $post->political_position = $request->input('political_position');
        else
            $post->political_position = 'Did not identify';

        $post->figure_id = $request->input('figure_id');
        $post->user_id = 0;

        if(!Auth::Guest()){
            $post->user_id = auth()->user()->id;
            $post->username = auth()->user()->username;
        }
        else
            $post->username = "guest";
        $post->cover_image = $fileNameToStore;

        //getting name of the figure and storing it in variable "$name"
        $first_nameOb = DB::table('figures')
            ->select('first_name')
            ->where('id', $post->figure_id)
            ->first();
        $first_name = $first_nameOb->first_name;
        $last_nameOb = DB::table('figures')
            ->select('last_name')
            ->where('id', $post->figure_id)
            ->first();
        $last_name = $last_nameOb->last_name;
        $name = $first_name." ".$last_name;
        $post->figure_name = $name;

        // Store sounds_like to make it searchable by similar spelling with $name
        $sounds_like = '';
        $sounds_like.= metaphone($request->input('title')).' ';
        $sounds_like.= metaphone($name);
        $post->sounds_like = $sounds_like;

        $post->save();
        $figure_id = $request->input('figure_id');

        //retrieving overall_rating, # of reviews, & public_trust_rating of the figure
        $overall_ratingOb = DB::table('figures')
            ->select('overall_rating')
            ->where('id', $figure_id)
            ->first();
        $numOfReviewsOb = DB::table('figures')
            ->select('numOfReviews')
            ->where('id', $figure_id)
            ->first();
        $public_trust_ratingOb = DB::table('figures')
            ->select('public_trust_rating')
            ->where('id', $figure_id)
            ->first();
        $overall_rating = $overall_ratingOb->overall_rating;
        $numOfReviews = $numOfReviewsOb->numOfReviews;
        $public_trust_rating = $public_trust_ratingOb->public_trust_rating;

        //calculating new overall_rating & public_trust_rating
        $overall_rating = ($overall_rating * $numOfReviews + $post->rating) / ++$numOfReviews;
        $public_trust_rating = ($public_trust_rating * ($numOfReviews - 1) + $post->trustworthiness) / $numOfReviews;

        DB::update("update figures set overall_rating = $overall_rating where id = ?",["$figure_id"]);
        DB::update("update figures set numOfReviews = $numOfReviews where id = ?",["$figure_id"]);
        DB::update("update figures set public_trust_rating = $public_trust_rating where id = ?",["$figure_id"]);


        return redirect("/figures/$figure_id")->with('success', 'Post Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $figure_idOb = DB::table('posts')
            ->select('figure_id')
            ->where('id', $id)
            ->first();
        $figure_id = $figure_idOb->figure_id;
        $figure = Figure::find($figure_id);

        $comments = DB::table('comments')
            ->where('post_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(40);


        return view('posts.show')
        ->with('post', $post)
        ->with('figure', $figure)
        ->with('comments', $comments);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $figure_idOb = DB::table('posts')
            ->select('figure_id')
            ->where('id', $id)
            ->first();
        $figure_id = $figure_idOb->figure_id;
        $figure = Figure::find($figure_id);

        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id == $post->user_id){
            return view('posts.edit')
            ->with('figure', $figure)
                ->with('post', $post);
        }

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
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
            'title' => 'required',
            'rating' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to Store with timestamp to make the name completely unique
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image/file
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        // Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->rating = $request->input('rating');
        if($request->input('body'))
            $post->body = $request->input('body');
        else
            $post->body = ' ';

        if($request->input('trustworthiness'))
            $post->trustworthiness = $request->input('trustworthiness');
        else
            $post->trustworthiness = 0;

        if($request->input('political_position'))
            $post->political_position = $request->input('political_position');
        else
            $post->political_position = 'Did not identify';
        
        $post->figure_id = $request->input('figure_id');
        $post->user_id = 0;

        if(!Auth::Guest()){
            $post->user_id = auth()->user()->id;
        }
        else
            $post->username = "guest";
            
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        } /*else { //shouldn't have this else statement
            $post->cover_image = 'noimage.jpg';
        }*/

        $first_nameOb = DB::table('figures')
            ->select('first_name')
            ->where('id', $post->figure_id)
            ->first();
        $first_name = $first_nameOb->first_name;
        $last_nameOb = DB::table('figures')
            ->select('last_name')
            ->where('id', $post->figure_id)
            ->first();
        $last_name = $last_nameOb->last_name;
        $name = $first_name.$last_name;
        $post->figure_name = $name;

        // Store sounds_like to make it searchable by similar spelling
        $sounds_like = '';
        $sounds_like.= metaphone($request->input('title')).' ';
        $sounds_like.= metaphone($name);
        $post->sounds_like = $sounds_like;

        $post->save();
        $figure_id = $request->input('figure_id');

        //retrieving overall_rating, # of reviews, & public_trust_rating of the figure
        $overall_ratingOb = DB::table('figures')
            ->select('overall_rating')
            ->where('id', $figure_id)
            ->first();
        $numOfReviewsOb = DB::table('figures')
            ->select('numOfReviews')
            ->where('id', $figure_id)
            ->first();
        $public_trust_ratingOb = DB::table('figures')
            ->select('public_trust_rating')
            ->where('id', $figure_id)
            ->first();
        $overall_rating = $overall_ratingOb->overall_rating;
        $numOfReviews = $numOfReviewsOb->numOfReviews;
        $public_trust_rating = $public_trust_ratingOb->public_trust_rating;

        //calculating the change in the ratings and its effects onto the figure's database
        $changeInRating = $post->rating - $request->input('past_rating');
        $changeInTrustworthiness = $post->trustworthiness - $request->input('past_trustworthiness');
        $changeInOverallRating = $changeInRating/$numOfReviews;
        $changeInPublicTrustRating = $changeInTrustworthiness/$numOfReviews;

        //adding the change to the database
        $overall_rating += $changeInOverallRating;
        $public_trust_rating += $changeInPublicTrustRating;

        DB::update("update figures set overall_rating = $overall_rating where id = ?",["$figure_id"]);
        DB::update("update figures set public_trust_rating = $public_trust_rating where id = ?",["$figure_id"]);
        DB::update("update figures set numOfReviews = $numOfReviews where id = ?",["$figure_id"]);


        return redirect("/figures/$figure_id")->with('success', 'Post Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = POST::find($id);

        if(auth()->user()->id == $post->user_id && $post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        // Check for correct user
        if(auth()->user()->id == $post->user_id){
            $rating = $post->rating;
            $trustworthiness = $post->trustworthiness;
            $figure = Figure::find($post->figure_id);
            //revert the effects on the ratings
            $figure_overallRating = $figure->overall_rating;
            $figure_numOfReviews = $figure->numOfReviews;
            $figure_public_trust_rating = $figure->public_trust_rating;
            //if there is only 1 or less reviews
            if($figure_numOfReviews > 1)
            {
                $figure_overallRating = ($figure_overallRating * $figure_numOfReviews - $rating)/--$figure_numOfReviews;
                $figure_public_trust_rating = ($figure_public_trust_rating * ($figure_numOfReviews + 1) - $trustworthiness)/$figure_numOfReviews;
            }
            else
            {
                $figure_overallRating = 0;
                $figure_numOfReviews = 0;
                $figure_public_trust_rating = 0;
            }
            $figure->overall_rating = $figure_overallRating;
            $figure->numOfReviews = $figure_numOfReviews;
            $figure->public_trust_rating = $figure_public_trust_rating;
            //delete comments & subcomments of the post
            Comment::where('post_id',$post->id)->delete();
            Subcomment::where('post_id',$post->id)->delete();
            //delete saved post and comments of this post
            SavedPost::where('post_id', $post->id)->delete();
            SavedComment::where('post_id', $post->id)->delete();
            $figure->save();
            $post->delete();
            return redirect('/posts')->with('success', 'Post Removed');
        }

        //send error if not the correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

    }
}
