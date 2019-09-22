<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/gif" href="./images/icon.gif"/>
    <title>Lastfm - {{ $profile->getUser() }}</title>
    <script src="/jquery.min.js"></script>
</head>

<body>

<div class="container col-11">
    <div class="row my-5 border">
        <div class="media">
            <a href="https://last.fm/user/{{ $profile->getUser() }}">
                <img src="{{ $profile->getAvatar() }}" class="align-self-start mr-3" alt="...">
            </a>
            <div class="media-body">
                <h1 class="mt-0">{{ $profile->getUser() }}</h1>
                <p>Since
                    {{ $profile->getRegistered() }}
                </p>

                <p>🔥
                    {{ $profile->getScrobbles() }} 🔥</p>
            </div>
        </div>
    </div>
    @if ($recentTracks->getScrobblingNow())
        <div class="row my-5">
            <h4>Scrobbling Now</h4>
            <ul class="list-unstyled w-100">
                <li class="media my-1 border">
                    <img width="80px" height="80px" src="{{ $recentTracks->getMiniature() }}" class="mr-3" alt="...">
                    <div class="media-body py-2 text-truncate">
                        <h5 class="mt-0 mb-1">{{ $recentTracks->getTrack() }}</h5>
                        <span>{{ $recentTracks->getArtist() }}</span>
                    </div>
                    <div class="my-auto mr-3"><img src="./images/icon.gif"></div>

                </li>
            </ul>
        </div>
    @endif
    <div class="row my-5">
        <h4>Recent Tracks</h4>
        <ul class="list-unstyled w-100">
            @foreach($recentTracks->getTracks() as $track)
                @if ($track['date'] == "Now")
                    @continue
                @endif

                <li class="media my-1 border">
                    <img width="80px" height="80px" src="{{ $track['miniature'] }}" class="mr-3" alt="...">
                    <div class="media-body py-2 text-truncate">
                        <h5 class="mt-0 mb-1">{{ $track['track'] }}</h5>
                        <span>{{ $track['artist'] }}</span>
                    </div>
                    <div class="my-auto mr-3">
                        {{ $track['date'] }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="row my-5">
        <h4>Lyrics</h4>
        <div class="w-100 px-3 py-3 border text-prewrap">
            @if ($recentTracks->getScrobblingNow())
                @if ($lyrics->getLyrics())
                    <div style="white-space: pre-wrap;">{{ $lyrics->getLyrics() }}</div>
                @else
                    not found
                @endif
            @else
                you're not listening now
            @endif
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
<script type="text/javascript">
    setInterval(function(){
        let lastTitle = "{!! $recentTracks->getTrack() !!}";
        $.ajax({
            type: "GET",
            url: window.location.href+"/title",
            success: function(data){
                if(lastTitle != data){
                    location.reload();
                }
            }
        });
    }, 5000);
</script>
