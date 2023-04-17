<?php

namespace App\Http\Admin\Controllers;

use App\Models\Tags;
use App\Models\Video;
use App\Models\TagsVideos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $videos = Video::latest()->paginate(20);
        return view('admin/video.index', compact('videos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tags = Tags::all();
        return view('admin/video.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function uploadVideo(Request $request)
    {
        $path = public_path('images');
        $images = [];

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        if (!empty($file)){
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
            $images[] = $name;
        }
        Session::push('images', $images);
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'embed_code'=> 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if ($validate) {
            $video = new Video();
            $video->name = $request->name;
            $video->description = $request->description;
            $video->embed_code = $request->embed_code;
            $video->images = json_encode(array_filter(Session::get('images')));

            if ($video->save()){
                Session::forget('images');
                if (!empty($request->tag_id)){
                    foreach ($request->tag_id as $id){
                        $videoTags = new TagsVideos();
                        $videoTags->tags_id = $id;
                        $videoTags->videos_id = $video->id;
                        $videoTags->save();
                    }
                }
            }
            return redirect()->route('videos.index')
                ->with('success', 'video created successfully.');
        }

        return back()
            ->with('error','Unexpected error occured');

    }

    /**
     * Display the specified resource.
     *
     * @param Video $video
     * @return Response
     */
    public function show(Video $video)
    {
        return view('admin/video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Video $video
     * @return Response
     */
    public function edit(Video $video)
    {
        $allTags = Tags::all();
        $tags = Tags::with('videos')->get();

        return view('admin/video.edit', compact('video', 'allTags','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Video $video
     * @return Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $video->update($request->all());

        return redirect()->route('videos.index')
            ->with('success', 'video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Video $video
     * @return Response
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')
            ->with('success', 'video deleted successfully');
    }

    public function fetch(){
        $images = \File::allFiles(public_path('images'));
        $output = '<div class="row">';
        foreach($images as $image)
        {
            $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
            </div>
      ';
        }
        $output .= '</div>';
        echo $output;
    }

    function delete(Request $request)
    {
        if($request->get('name'))
        {
            \File::delete(public_path('images/' . $request->get('name')));
        }
    }
}
