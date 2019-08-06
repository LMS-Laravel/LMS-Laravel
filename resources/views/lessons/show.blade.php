@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"><b>@lang('lesson/lessons.lesson'):</b> {{ $lesson->title }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">b
                                {{ session('status') }}
                            </div>
                        @endif
                        Stream/Video
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">b
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! $lesson->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

