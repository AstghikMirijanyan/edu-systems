<!DOCTYPE html>
<html>
<head>
    <title>mini version Video tube</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
</head>
<body>

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Video</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tags.index') }}" enctype="multipart/form-data">
                    Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('videos.update',$video->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 form-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="{{ $video->name }}" class="form-control"/>
                </div>
                <div class="col-md-6 form-group">
                    <label>Description:</label>
                    <input type="text" name="description" value="{{ $video->description }}" class="form-control"/>
                </div>
                <div class="col-md-6 form-group">
                    <label>Embed code:</label>
                    <td><iframe width="420" height="315" src="{{ $video->embed_code }}" frameborder="0" allowfullscreen></iframe>
                    </td>
                    <input type="text" name="embed_code" value="{{ $video->embed_code }}" class="form-control"/>
                </div>
                <div class="col-md-6 form-group">
                    <label>Tags:</label>
                    <select multiple name="tag_id[]" class="form-control" aria-label="Default select example">
                        @foreach ($allTags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <?php $jsonString = $video->images;

                $array = json_decode($jsonString);
                $images = array_map(function ($arr) {
                    return $arr[0];
                }, $array);
                ?>
                @foreach($images as $image)
                    <img width="100" src="{{ asset('images/'.$image) }}" alt="{{$image}}">
                @endforeach
                <div class="col-md-6 form-group form-group">
                    <label for="document">Images</label>
                    <div class="needsclick dropzone" id="document-dropzone">
                    </div>
                <div class="col-md-6 form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: "{{ route('store.videos') }}",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->document)
            var files =
                {!! json_encode($project->document) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
</script>
