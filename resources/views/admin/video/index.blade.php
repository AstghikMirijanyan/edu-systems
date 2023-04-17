<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Videos</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('videos.create') }}"> Create Video</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Video Name</th>
            <th>Video Description</th>
            <th>Video</th>
            <th>Photos</th>

            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($videos as $video)
            <tr>
                <td>{{ $video->id }}</td>
                <td>{{ $video->name }}</td>
                <td>{{ $video->description }}</td>
                <td>
                    <iframe width="420" height="315" src="{{ $video->embed_code }}" frameborder="0"
                            allowfullscreen></iframe>
                </td>
                <td><?php $jsonString = $video->images;

                        $array = json_decode($jsonString);
                        $images = array_map(function ($arr) {
                            return $arr[0];
                        }, $array);
                        ?>
                    @foreach($images as $image)
                        <img width="50" src="{{ asset('images/'.$image) }}" alt="{{$image}}">
                    @endforeach
                </td>
                <td>
                    <form action="{{ route('videos.destroy',$video->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('videos.edit',$video->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $videos->links() !!}
</div>
</body>
</html>
