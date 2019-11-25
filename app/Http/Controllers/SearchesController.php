<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Figure;
use DB;

use Illuminate\Support\Facades\Auth;

class SearchesController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);
        $search = metaphone($request->input('search'));


        $posts = Post::where('sounds_like','LIKE',"%{$search}%")
            ->orderBy('numOfComments', 'desc')
            ->paginate(100);

        return view('posts.index')->with('posts',$posts);
    }
    public function figureSearch(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);
        $search = metaphone($request->input('search'));


        $figures = Figure::where('sounds_like','LIKE',"%{$search}%")
            ->orderBy('numOfReviews', 'desc')
            ->paginate(100);

        return view('pages.indexcopy')
        ->with('figures',$figures)
        ->with('variable', TRUE);;
    }
}
