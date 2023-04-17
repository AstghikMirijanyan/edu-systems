<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tags = Tags::latest()->paginate(5);
        $videos = [];
        if (!empty($request->tag_id)) {
            $tagId = $request->tag_id;
            $tag = Tags::find($tagId);
            $videos = $tag->videos;
        }
        return view('tags', compact('tags', 'videos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


}
