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
                        <div class="col-md-12">
                            @foreach($streamers as $streamer)
                                <span style="float: left">
                                    <a href="{{ route('showStreamer', ['streamer' => $streamer['id']]) }}">
                                        {{$streamer['name']}}
                                    </a>
                                </span>
                                <span style="float: right">
                                    <form id="delete-form-{{ $streamer['id'] }}" method="POST"
                                          action="{{ route('deleteStreamer', ['streamer' => $streamer['id']]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="javascript:$('#delete-form-{{ $streamer['id'] }}').submit();">X</a>
                                    </form>
                                </span>
                                </br>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
