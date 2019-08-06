@extends('layouts.master')

@section('content')
<div class="col-md-12">
    {{ Form::open(['url' => route('courses.update', $course->id), 'method' => 'PUT']) }}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">@lang('course/fields.courses')</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">@lang('course/fields.name')</label>
                <input type="text" id="name"  name="name" value="{{ old('name', $course->name) }}" class="form-control">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">@lang('course/fields.description')</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="teacher_id">@lang('course/fields.teacher')</label>
                {{ Form::select('teacher_id', $users, old('teacher_id', $course->teacher_id), ['class' => 'form-control custom-select']) }}
                @if ($errors->has('teacher_id'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('teacher_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-12">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">@lang('general.cancel')</a>
                <input type="submit" value="@lang('course/actions.update')" class="btn btn-primary float-right">
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    {{ Form::close() }}
</div>

<div class="col-md-12">
    <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card card-primary">
            <div class="card-header d-flex p-0">
                <h4 class="card-title p-3">
                    <a data-toggle="collapse" aria-expanded="true" data-parent="#accordion" href="#lessons">
                        Lessons
                    </a>
                </h4>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        @can('edit_lessons')
                            <a href="{{ route('lessons.create', $course->id) }}" class="btn btn-primary">@lang('general.new')</a>
                        @endcan
                    </li>
                </ul>
            </div>
            <div id="lessons" class="panel-collapse collapse show">
                <div class="card-body">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.content -->
@endsection


