
    <h3>Last Videos</h3>
    <br>
    @foreach($videos as $video)
        <div class="col-md-3">
            <div class="card video-card">
                <div class="card-body">
                    <h5 class="card-title video-title">{{$video->name}}</h5>
                    <p class="card-text video-description">{{$video->description }}</p>
                    <iframe width="300" height="300" src="{{ $video->embed_code }}" frameborder="0"
                            allowfullscreen></iframe>
                    <ul class="video-tags">
                        @foreach($video->tags as $tag)
                            <li class="video-tag">{{$tag->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach

