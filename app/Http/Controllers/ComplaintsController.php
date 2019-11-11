<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ComplaintsController extends Controller
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
            $complaints = DB::table('complaints')->orderBy('created_at', 'desc')->paginate(35);
            return view('complaints.index')->with('complaints',$complaints);
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
        return view('complaints.create');
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
            $path = $request->file('cover_image')->storeAs('public/cover_images/complaints', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Store data
        if(!Auth::Guest()){
            DB::table('complaints')->insert(
                ['title' => $request->input('title'),
                'body' => $request->input('body'),
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i'),
                'cover_image' => $fileNameToStore]
            );
        }
        else {
            DB::table('complaints')->insert(
            ['title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => 0,
            'created_at' => date('Y-m-d H:i'),
            'cover_image' => $fileNameToStore]
            );
        }

        return redirect("/complaints/create")->with('success', 'Sent Complaint');
    }
}
