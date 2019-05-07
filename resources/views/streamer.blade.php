@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Streamer {{ $streamer['name'] }}</div>

                    <div class="card-body">
                        <div id="twitch-embed"></div>
                    </div>

                    <div class="card-body">
                        Last events :
                        @forelse ($events as $event)
                            <li>{{ $event['name'] }} : {{ $event['description'] }}</li>
                        @empty
                            <p>No events</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://embed.twitch.tv/embed/v1.js"></script>
    <script type="text/javascript">
        var embed = new Twitch.Embed("twitch-embed", {
            width: '100%',
            height: '450',
            channel: "{{ $streamer['name'] }}",
            autoplay: false
        });

        embed.addEventListener(Twitch.Embed.VIDEO_READY, () => {
            var player = embed.getPlayer();
            player.play();
        });
    </script>
@endsection
