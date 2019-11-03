<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ComplaintsController extends Controller
{
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

        // Store data
        if(!Auth::Guest()){
            DB::table('complaints')->insert(
                ['title' => $request->input('title'),
                'body' => $request->input('body'),
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i')]
            );
        }
        else
            DB::table('complaints')->insert(
            ['title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => 0,
            'created_at' => date('Y-m-d H:i')]
            );

        return redirect("/complaints/create")->with('success', 'Sent Complaint');
    }
}