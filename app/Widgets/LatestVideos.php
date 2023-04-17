<?php

namespace App\Widgets;

use App\Models\Video;
use Arrilot\Widgets\AbstractWidget;

class LatestVideos extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 3
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {

        $videos = Video::latest()->take($this->config['count'])->get();

        return view('widgets.latest_videos', [
            'config' => $this->config,
            'videos'=> $videos
        ]);
    }
}
