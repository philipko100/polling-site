<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ReportBugsController extends Controller
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
     *//*
    public function index()
    {
        $reports = DB::table('report_bugs')->where('user_id', auth()->user()->id)->paginate(35);
        return view('reportbugs.index')->with('reports',$reports);
    }
    */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('reportbugs.create');
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
            DB::table('report_bugs')->insert(
                ['title' => $request->input('title'),
                'body' => $request->input('body'),
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i')]
            );
        }
        else
            DB::table('report_bugs')->insert(
            ['title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => 0]
            );


        return redirect("/reportbugs/create")->with('success', 'Sent Report');
    }

}
