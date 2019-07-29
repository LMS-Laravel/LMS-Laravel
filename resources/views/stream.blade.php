@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <chat :user="{{ auth()->user() }}"></chat>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bienvenido {{ auth()->user()->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">b
                                {{ session('status') }}
                            </div>
                        @endif

                        <iframe width="100%" height="450px" src="//159.65.221.105:/LiveApp/play.html?name={{ env('STREAM_KEY') }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

