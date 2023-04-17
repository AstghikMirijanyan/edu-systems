<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageUploader extends Component
{
    /**
     * The name of the input field.
     *
     * @var string
     */
    public $name;

    /**
     * The maximum number of images that can be uploaded.
     *
     * @var int
     */
    public $maxFiles;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param int $maxFiles
     */
    public function __construct($name = 'images', $maxFiles = 5)
    {
        $this->name = $name;
        $this->maxFiles = $maxFiles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.image-uploader');
    }
}
