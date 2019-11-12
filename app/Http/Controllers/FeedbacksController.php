<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check for correct user
        if(auth()->user()->isAdmin){
            $feedbacks = DB::table('feedbacks')->orderBy('created_at', 'desc')->paginate(35);
            return view('feedbacks.index')->with('feedbacks',$feedbacks);
        }

        return redirect('/')->with('error', 'Unauthorized page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('feedbacks.create');
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
            'body' => 'required',
            'website_rating' => 'required',
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
            $path = $request->file('cover_image')->storeAs('public/cover_images/feedbacks', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Store data
        if(!Auth::Guest()){
            DB::table('feedbacks')->insert(
                ['title' => $request->input('title'),
                'body' => $request->input('body'),
                'website_rating' => $request->input('website_rating'),
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i'),
                'cover_image' => $fileNameToStore]
            );
        }
        else {
            DB::table('feedbacks')->insert(
            ['title' => $request->input('title'),
            'body' => $request->input('body'),
            'website_rating' => $request->input('website_rating'),
            'user_id' => 0,
            'created_at' => date('Y-m-d H:i'),
            'cover_image' => $fileNameToStore]
            );
        }


        return redirect("/feedbacks/create")->with('success', 'Sent Feedback');
    }
}
