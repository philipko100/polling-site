<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Figure; //import model
use App\Post;
use App\Comment;
use DB;

class PagesController extends Controller
{
    
    public function index(){
        $figures = Figure::orderBy('overall_rating', 'desc')->paginate(35); 
        return view('pages.index')->with('figures',$figures);
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title',$title);
    }


    public function show($id)
    {
        $figure = Figure::find($id);
        $posts = DB::table('posts')
            ->orderBy('created_at', 'desc')
            ->where('figure_id', "$id")
            ->paginate(15);
        return view('pages.show')
            ->with('figure', $figure)
            ->with('posts', $posts);
    }

    public function create ()
    {

        // Check for correct user
        if(auth()->user()->id < 10){
            return view('pages.create');
        }

        if(auth()->user()->id !== $post->user_id){
            return redirect('/')->with('error', 'Unauthorized page');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'occupation' => 'required',
            'self_position' => 'required',
            'bio' => 'required',
            'lastname' => 'required',
            'cover_image' => 'required'
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

        // Create Figure
        $figure = new Figure;
        $figure->first_name = $request->input('firstname');
        $figure->last_name = $request->input('lastname');
        $figure->occupation = $request->input('occupation');
        $figure->self_position = $request->input('self_position');
        $figure->bio = strip_tags($request->input('bio'));

        $figure->cover_image = $fileNameToStore;

        // Store sounds_like to make it searchable by similar spelling
        $sounds_like = '';
        $sounds_like.= metaphone($figure->first_name).' ';
        $sounds_like.= metaphone($figure->last_name).' ';
        $sounds_like.= metaphone($figure->occupation).' ';
        $sounds_like.= metaphone($figure->self_position);
        $figure->sounds_like = $sounds_like;
        
        $figure->overall_rating = 0;
        $figure->numOfReviews = 0;
        $figure->public_trust_rating = 0;
        $figure->save();

        return redirect("/figures/$figure->id")->with('success', 'Figure Created');
    }

    public function edit ($id)
    {
        $figure = Figure::find($id);

        // Check for correct user
        if(auth()->user()->id < 10){
            return view('pages.edit')->with('figure', $figure);
        }

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'occupation'=> 'required',
            'self_position' => 'required',
            'bio' => 'required',
            'cover_image' => 'required'
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

        // Create Figure
        $figure = Figure::find($id);
        $figure->first_name = $request->input('firstname');
        $figure->last_name = $request->input('lastname');
        $figure->occupation = $request->input('occupation');
        $figure->self_position = $request->input('self_position');
        $figure->bio = strip_tags($request->input('bio'));

        $figure->cover_image = $fileNameToStore;

        // Store sounds_like to make it searchable by similar spelling
        $sounds_like = '';
        $sounds_like.= metaphone($figure->first_name).' ';
        $sounds_like.= metaphone($figure->last_name).' ';
        $sounds_like.= metaphone($figure->occupation).' ';
        $sounds_like.= metaphone($figure->self_position);
        $figure->sounds_like = $sounds_like;

        $figure->save();

        return redirect("/figures/$id")->with('success', 'Figure Edited');
    }

    public function destroy($id)
    { 
        $figure = Figure::find($id);

        if(auth()->user()->id < 10 && $figure->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$figure->cover_image);
        }

        // Check for correct user
        if(auth()->user()->id < 10){
            //delete comments of figures
            $posts = Post::where('figure_id',$id)->get();
            foreach($posts as $post)
            {
                $postid = $post->id;
                Comment::where('post_id',$postid)->delete();
            }
            //delete posts of figures
            Post::where('figure_id',$id)->delete();
            $figure->delete();
            return redirect('/')->with('success', 'Figure Removed');
        }


        if(auth()->user()->id >= 10){
            return redirect('/')->with('error', 'Unauthorized page');
        }
    }
}
