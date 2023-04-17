<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        .video-gallery {
            margin: 10px auto;
            max-width: 100%;
        }

        .video-card {
            max-width: 350px;
            margin: 20px;
        }

        .video-thumbnail img {
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .video-title {
            font-weight: bold;
            margin-top: 10px;
            cursor: pointer;
        }

        .video-description {
            margin-top: 5px;
            color: #666;
            cursor: pointer;
        }

        .video-tags {
            list-style: none;
            padding: 0;
            margin: 10px 0 0;
            display: flex;
            flex-wrap: wrap;
        }

        .video-tag {
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 5px 10px;
            background-color: #f1f1f1;
            font-size: 0.8rem;
            cursor: pointer;
        }
    </style>
</head>
<body class="antialiased">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/listingpage">Listing Page </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/videos">Videos <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/tags">Tags</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="container video-gallery">

    <div class="row">
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
    </div>
    <div class="row">

        @widget('LatestVideos', ['count' => 3])

    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
