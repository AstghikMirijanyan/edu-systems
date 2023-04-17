<?php

namespace App\Http\Admin\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tags::latest()->paginate(20);
        return view('admin/tags.index', compact('tags'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tags::create($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'tag created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Tags $tag
     * @return Response
     */
    public function show(Tags $tag)
    {
        return view('admin/tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tags $tag
     * @return Response
     */
    public function edit(Tags $tag)
    {
        return view('admin/tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tags $tag
     * @return Response
     */
    public function update(Request $request, Tags $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tags $tag
     * @return Response
     */
    public function destroy(Tags $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully');
    }
}
