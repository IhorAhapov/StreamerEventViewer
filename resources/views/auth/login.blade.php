@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        Login with:
                        @foreach($social_types as $social_type)
                            <div class="form-group row">
                                <a class="btn btn-link"
                                   href="{{ route('socialLogin', ['provider' => $social_type['name']]) }}">
                                    {{ ucfirst($social_type['name']) }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
