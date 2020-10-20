@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        {{ Form::open(['url' => route('lessons.store')]) }}
        {{ Form::hidden('course_id', $course->id) }}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">@lang('lesson/fields.courses')</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">@lang('lesson/fields.title')</label>
                    <input type="text" id="title" value="{{old('title')}}"  name="title" class="form-control">
                    @if ($errors->has('title'))
                        <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
                <textarea id="laraberg" {{old('content')}} name="content" hidden></textarea>
                @if ($errors->has('content'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="col-12">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">@lang('general.cancel')</a>
                <input type="submit" value="@lang('lesson/actions.create')" class="btn btn-success float-right">
            </div>
        </div>
        </div>
        <!-- /.card -->

        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/moment@2.24.0/min/moment.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        Laraberg.init('laraberg', { laravelFilemanager: true })
    </script>
@endsection
