@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Add your favorite streamer
                        <form method="POST" action="{{ route('addStreamer') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Find</button>
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>

                    <div class="card-body">
                        Your streamers:
                        @foreach($streamers as $streamer)
                            <div class="input-group mb-3">
                                <a href="{{ route('showStreamer', ['id' => $streamer['id']]) }}">
                                {{$streamer['name']}} <!-- todo think about delete streamer -->
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
