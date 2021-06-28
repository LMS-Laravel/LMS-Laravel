@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }} {{ auth()->user()->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">b
                                {{ session('status') }}
                            </div>
                        @endif
                        <!--<stream :url_stream="'{{ env('MEDIA_URL')  }}'" :stream_id="{{ env('STREAM_KEY') }}"></stream>-->
                        <!--<iframe width="100%" height="450px" src="//{{env('MEDIA_URL')}}:/LiveApp/play.html?name={{ env('STREAM_KEY') }}&autoplay=true" frameborder="0" allowfullscreen></iframe>-->
                        <iframe width="100%" height="450px" src="{{  Config::get('settings.media_server_url') }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <chat :user="{{ auth()->user() }}" :resource="0" :type="'stream'" prompt="{{__('What would you like to share?')}}"></chat>
            </div>
        </div>
    </div>
@endsection
