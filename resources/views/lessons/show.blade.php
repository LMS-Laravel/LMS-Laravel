@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>@lang('lesson/lessons.lesson'):</b> {{ $lesson->title }}</div>
                    <div class="card-body">
                        {!! $lesson->content !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <chat :user="{{ auth()->user() }}" :resource="{{ $lesson->id }}" :type="'lesson'"></chat>
            </div>
        </div>
    </div>
@endsection

