<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $videos = Video::latest()->paginate(5);
        return view('listingpage', compact('videos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     * @return Response
     */
    public function show()
    {
        $videos = Video::latest()->paginate(5);
        return view('videos', compact('videos'));
    }

}
